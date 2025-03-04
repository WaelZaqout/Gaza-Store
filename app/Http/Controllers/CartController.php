<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller{

    public function addToShoping(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int)$request->input('quantity', 1); // التأكد من القيمة

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // السلة
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // إذا كان المنتج موجودًا، حدث الكمية
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // أضف منتج جديد
            $cart[$productId] = [
                "image" => $product->image ? $product->image->path : null,
                'name' => $product->trans_name,
                'quantity' => $quantity,
                'price' => $product->price,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('front.shoping')->with('success', 'Product added to cart successfully.');
    }


    public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()
    ->with('success', 'Product removed from cart!');
}


}
