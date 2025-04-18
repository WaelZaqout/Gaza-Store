<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Cart;
use App\Models\order;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\payments;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\order_details;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'يجب عليك تسجيل الدخول لإتمام الطلب.');
        }

        $payment_method = $request->input('payment_method');

        // جلب السلة
        $carts = Cart::where('user_id', $user->id)->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'السلة فارغة!');
        }

        $total_price = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        if ($payment_method === 'cod') {
            // الدفع عند التسليم
            $order = new order();
            $order->user_id = $user->id;
            $order->total_price = $total_price;
            $order->status = 'pending';
            $order->save();

            foreach ($carts as $cart) {
                order_details::create([
                    'order_id'   => $order->id,
                    'user_id'    => $user->id,
                    'product_id' => $cart->product_id,
                    'quantity'   => $cart->quantity,
                    'price'      => $cart->product->price,
                    'total'      => $cart->product->price * $cart->quantity,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();

            return view('front.checkout.success', compact('order'));
        } else {
            // الدفع الإلكتروني (Stripe)
            try {
                // أنشئ الطلب أولاً
                $order = new order();
                $order->user_id = $user->id;
                $order->total_price = $total_price;
                $order->status = 'pending';
                $order->save();

                Stripe::setApiKey(config('services.stripe.secret'));
                $YOUR_DOMAIN = env('APP_URL');

                $checkout_session = Session::create([
                    'line_items' => [[
                        'price_data' => [
                            'currency'     => 'usd',
                            'product_data' => ['name' => 'Order #' . $order->id],
                            'unit_amount'  => $total_price * 100,
                        ],
                        'quantity' => 1,
                    ]],
                    'mode'         => 'payment',
                    'metadata'     => ['order_id' => $order->id],
                    'success_url'  => $YOUR_DOMAIN . '/checkout/success?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url'   => $YOUR_DOMAIN . '/checkout/canceled?order_id=' . $order->id,
                ]);

                // احفظ session_id في الطلب إن أردت (يتطلب تعديل قاعدة البيانات)
                // $order->session_id = $checkout_session->id;
                // $order->save();

                return redirect($checkout_session->url);

            } catch (\Exception $e) {
                return back()->with('error', 'حدث خطأ أثناء معالجة الدفع: ' . $e->getMessage());
            }
        }
    }


    public function checkout(Request $request){

        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $products = Product::all();
        return view('front.checkout.checkout', compact('carts','products'));
    }


   public function processCheckout(Request $request)
    {
        // الحصول على السلة للمستخدم الحالي
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'السلة فارغة!');
        }

        // إنشاء طلب جديد بحالة "pending"
        $order = new order();
        $order->user_id = auth()->id();
        $order->total_price = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });
        $order->status='pending'; // لم يتم الدفع بعد
        $order->save();

        // حفظ تفاصيل الطلب في order_details
        foreach ($carts as $cart) {
            order_details::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
                'total' => $cart->product->price * $cart->quantity,
            ]);
        }

        // تفريغ السلة بعد إنشاء الطلب
        Cart::where('user_id', auth()->id())->delete();

        // تحويل المستخدم لصفحة الدفع باستخدام Stripe
        return redirect()->route('checkout.process', ['order_id' => $order->id]);
    }
    public function paymentSuccess(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session_id = $request->query('session_id');
        if (!$session_id) {
            return redirect()->route('checkout')->with('error', 'تعذر العثور على معلومات الدفع.');
        }

        try {
            $session = Session::retrieve($session_id);
            $order_id = $session->metadata['order_id'] ?? null;

            if (!$order_id) {
                return redirect()->route('checkout')->with('error', 'لم يتم العثور على الطلب.');
            }

            $order = Order::find($order_id);

            if (!$order) {
                return redirect()->route('checkout')->with('error', 'لم يتم العثور على الطلب.');
            }

            // ✅ حفظ تفاصيل الطلب بعد الدفع
            $carts = Cart::where('user_id', $order->user_id)->with('product')->get();
            foreach ($carts as $cart) {
                order_details::create([
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                    'total' => $cart->product->price * $cart->quantity,
                ]);
            }

            // ✅ تفريغ السلة
            Cart::where('user_id', $order->user_id)->delete();

            // ✅ تحديث حالة الطلب
            $order->status = 'paid';
            $order->save();

            return view('front.checkout.success', compact('order'));

        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'حدث خطأ أثناء معالجة الدفع.');
        }
    }


    public function paymentCanceled(Request $request)
    {
        $order_id = $request->query('order_id');
        $order = Order::find($order_id);

        if ($order) {
            $order->status = 'canceled';
            $order->save();
        }

        return view('front.checkout.canceled');
    }


    }
