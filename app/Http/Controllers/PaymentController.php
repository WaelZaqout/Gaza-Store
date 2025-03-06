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

        // جلب بيانات السلة للمستخدم الحالي
        $carts = Cart::where('user_id', $user->id)->with('product')->get();
        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'السلة فارغة!');
        }

        // حساب إجمالي السعر
        $total_price = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        try {
            DB::beginTransaction(); // بدء معاملة

            // إنشاء الطلب
            $order = new order();
            $order->user_id = $user->id;
            $order->total_price = $total_price;
            $order->status = $request->payment_method === 'cod' ? 'pending' : 'pending';
            $order->save();

            // إنشاء تفاصيل الطلب
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

            // تفريغ السلة
            Cart::where('user_id', $user->id)->delete();

            DB::commit(); // حفظ المعاملة

            // الدفع عند التسليم
            if ($request->payment_method === 'cod') {
                return redirect()->route('checkout.success')->with('success', 'تم إنشاء الطلب بنجاح وسيتم الدفع عند التسليم.');
            }

            // الدفع الإلكتروني عبر Stripe
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

            // حفظ session_id داخل الطلب
            $order->session_id = $checkout_session->id;
            $order->save();

            return redirect($checkout_session->url);

        } catch (\Exception $e) {
            DB::rollBack(); // إلغاء العملية في حالة الخطأ
            return back()->with('error', 'حدث خطأ أثناء معالجة الدفع: ' . $e->getMessage());
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
            $order = Order::where('session_id', $session->id)->first();

            if (!$order) {
                return redirect()->route('checkout')->with('error', 'لم يتم العثور على الطلب.');
            }

            // تحديث حالة الطلب إلى "مدفوع"
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
