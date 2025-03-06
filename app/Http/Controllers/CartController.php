<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller{

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // تحقق إذا كان المنتج في السلة بالفعل
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $productId)
                    ->first();

        if ($cart) {
            // إذا كان المنتج في السلة، قم بتحديث الكمية
            $cart->quantity += $request->input('quantity', 1);
            $cart->save();
            return response()->json(['message' => 'Product quantity updated in the cart.']);
        } else {
            // إذا لم يكن في السلة، أضفه
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'price' => $product->price,
                'quantity' => $request->input('quantity', 1),
            ]);
            return response()->json(['message' => 'Product added to cart successfully.']);
        }
    }



    public function removeFromcart($id)
    {

            $cart = Cart::where('user_id', auth()->id())
                ->where('id', $id) // التحقق من ID المفضل
                ->first();

            if ($cart) {
                $cart->delete(); // حذف المنتج
                return response()->noContent(); // إعادة استجابة بدون محتوى
            }

            return response()->json(['message' => 'لم يتم العثور على العنصر.'], 404); // إذا لم يتم العثور عليه
        }


    public function toggleCart(Request $request)
    {
        $productId = $request->input('product_id');

        // تحقق من وجود المنتج
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $cart = Cart::where([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'price' => $product->price, // استخدم السعر من جدول المنتجات
            'quantity' => $request->input('quantity', 1), // إذا لم يتم إرسال الكمية، افترض القيمة 1
        ])->first();

        if ($cart) {
            // حذف المنتج من المفضلة
            $cart->delete();
            return response()->json(['message' => 'Product removed from carts.', 'status' => 'removed']);
        } else {
            // إضافة المنتج إلى المفضلة
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'price' => $product->price, // استخدم السعر من جدول المنتجات
                'quantity' => $request->input('quantity', 1), // إذا لم يتم إرسال الكمية، افترض القيمة 1

            ]);
            return response()->json(['message' => 'Product added to carts successfully.', 'status' => 'added']);
        }
    }

    public function isCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $isCart = Cart::where([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'price' => $product->price,
            'quantity' => $request->input('quantity', 1),
        ])->exists();

        return response()->json(['isCart' => $isCart]);
    }

    // عرض صفحة المفضلة
    public function cartsPage()
    {
        // جلب العناصر المفضلة وعددها
        $carts = Auth::user()->cart; // يفترض أن لديك علاقة مفضلة مع المستخدم
        $cartsCount = Auth::user()->carts ? Auth::user()->carts->count() : 0;
        $categories = Category::all();


        // تمرير البيانات إلى العرض
        return view('front.carts', compact('carts', 'cartsCount','categories'));
    }

    public function getCartsCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]); // إذا لم يكن هناك مستخدم، أعد 0 بدلاً من خطأ
        }

        $cartsCount = optional(Auth::user()->cart)->count() ?? 0; // تجنب الأخطاء في حالة عدم وجود سلة
        return response()->json(['count' => $cartsCount]);
    }


}
