<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     function index()
    {
        $products = Product::latest('id')->paginate(4);

        $categories = Category::all();

        return view('front.index' ,compact('categories','products'));
    }


     public function products()
        {
            $categories = Category::all();
            $products = Product::latest('id')->paginate(4);

            return view('front.products', compact('categories', 'products'));
        }


        public function show($id)
        {
            try {
                $product = Product::with('images')->findOrFail($id);

                // جمع مسارات الصور في مصفوفة
                $images = $product->images->map(function ($image) {
                    return asset('images/' . $image->path);
                });

                return response()->json([

                    'name' => $product->trans_name,
                    'price' => $product->price,
                    'description' => $product->trans_description,
                    'images' => $images // إرسال الصور مع الاستجابة
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return response()->json(['error' => 'Product not found'], 404);
            }


        }

        public function filterProducts($id)
        {
            if ($id === 'all') {
                $products = Product::latest()->paginate(4); // استخدم paginate
            } else {
                $products = Product::where('category_id', $id)->latest()->paginate();
            }

            return view('front.partials.products', compact('products', 'id'));
        }


        public function getProduct($id)
        {
            $product = Product::with('image', 'gallery')->findOrFail($id);

            // تحقق مما إذا كان الطلب يتوقع استجابة JSON
            if (request()->expectsJson()) {
                return response()->json([
                    'id' => $product->id,
                    'name' => $product->trans_name,
                    'price' => $product->price,
                    'description' => $product->trans_description,
                    'image' => $product->image ? $product->image->path : null,
                    'gallery' => $product->gallery ? $product->gallery->toArray() : []
                ]);
            }

            // إذا لم يكن الطلب يتوقع استجابة JSON، قم بعرض الواجهة
            return view('front.partials.products', compact('product'));
        }






    function shoping(Request $request){
        $cart = Cart::where('user_id', auth()->id())->get();  // استرجاع سلة المستخدم
        $products = Product::all();
        return view('front.shoping',compact('products','cart'));

     }
     function favorites(Request $request){
        $cart = Cart::where('user_id', auth()->id())->get();  // استرجاع سلة المستخدم
        $products = Product::all();
        return view('front.favorites',compact('products','cart'));

     }


     public function search(Request $request)
     {
         $query = $request->input('query');

         // البحث في قاعدة البيانات عن المنتجات التي تحتوي على النص
         $products = Product::where('trans_name', 'LIKE', "%{$query}%")
                             ->orWhere('description', 'LIKE', "%{$query}%");


         // إعادة النتائج بصيغة JSON
         return response()->json($products);
     }


}
