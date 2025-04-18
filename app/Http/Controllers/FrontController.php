<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Silder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     function index()
    {
        $products = Product::latest('id')->paginate(4);
        $categories = Category::all();
        $carts = Cart::all();
        $silders = Silder::all();

        return view('front.index' ,compact('categories','products','silders','carts'));
    }


     public function products($id)
        {
            $categories = Category::all();
            $carts = Cart::all();
            // $products = Product::latest('id')->paginate(4);
            $product = Product::with('variants')->findOrFail($id);

            return view('front.products', compact('categories', 'products','carts'));
        }


        public function show($id)
        {
            try {
                $product = Product::with(['images', 'variants'])->findOrFail($id);

                // جمع مسارات الصور
                $images = $product->images->map(function ($image) {
                    return asset('images/' . $image->path);
                });

                // جمع الخيارات (الحجم واللون والكمية)
                $variants = $product->variants->map(function ($variant) {
                    return [
                        'size' => $variant->size,
                        'color' => $variant->color,
                        'quantity' => $variant->quantity,
                    ];
                });

                return response()->json([
                    'name' => $product->trans_name,
                    'price' => $product->price,
                    'description' => $product->trans_description,
                    'images' => $images,
                    'variants' => $variants,
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
            $product = Product::with(['image', 'gallery', 'variants'])->findOrFail($id);

            // تصفية المتغيرات المتوفرة فقط (الكمية > 0)
            $variants = $product->variants->where('quantity', '>', 0);

            // استخراج الأحجام والألوان الفريدة
            $sizes = $variants->pluck('size')->unique()->values();
            $colors = $variants->pluck('color')->unique()->values();

            // إعادة المتغيرات كاملة (للربط بين الحجم واللون في JS)
            $variantList = $variants->map(function ($variant) {
                return [
                    'size' => $variant->size,
                    'color' => $variant->color,
                    'quantity' => $variant->quantity,
                ];
            });

            return response()->json([
                'id' => $product->id,
                'name' => $product->trans_name,
                'price' => $product->price,
                'description' => $product->trans_description,
                'image' => $product->image ? $product->image->path : null,
                'gallery' => $product->gallery ? $product->gallery->toArray() : [],
                'sizes' => $sizes,
                'colors' => $colors,
                'variants' => $variantList, // ⬅️ هذا ضروري للتفاعل المتبادل في JavaScript
            ]);
        }




        public function favorites()
        {
            $favorites = Favorite::where('user_id', auth()->id())->with('product')->get();
            $products = Product::all();
            $categories = Category::all();
            return view('front.favorites', compact('favorites','categories','products','carts'));
        }
        public function carts()
        {
            $carts = Cart::where('user_id', auth()->id())->with('product')->get();
            $products = Product::all();
            $categories = Category::all();
            return view('front.carts', compact('carts','categories','products'));
        }
        public function checkout()
        {

            $carts = Cart::where('user_id', auth()->id())->with('product')->get();
            $products = Product::all();
            $categories = Category::all();
            return view('front.carts', compact('carts','categories','products'));
        }


        public function search(Request $request)
        {

                $query = $request->input('query');

                // البحث عن المنتجات حسب الاسم أو الوصف
                $products = Product::where('name', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->get();

                // إعادة المنتجات مع الصور إذا كانت موجودة
                $products->load('image', 'gallery');

                // إعادة المنتجات كـ JSON
                return response()->json(['products' => $products]);
        }


        public function blog()
        {
            $carts = Cart::where('user_id', auth()->id())->with('product')->get();
            $categories = Category::all();
            $products = Product::latest('id')->paginate(4);

            return view('front.blog', compact('carts','categories', 'products'));
        }

        public function about()
        {
            $carts = Cart::where('user_id', auth()->id())->with('product')->get();
            $categories = Category::all();
            $products = Product::latest('id')->paginate(4);

            return view('front.about', compact('carts','categories', 'products'));
        }
        public function contact()
        {
            $carts = Cart::where('user_id', auth()->id())->with('product')->get();
            $categories = Category::all();
            $products = Product::latest('id')->paginate(4);

            return view('front.contact', compact('carts','categories', 'products'));
        }

        public function footer()
        {
            $carts = Cart::where('user_id', auth()->id())->with('product')->get();
            $categories = Category::all();
            $products = Product::latest('id')->paginate(4);

            return view('front.master', compact('categories', 'products','carts'));
        }



        function profile(){

            $carts = Cart::where('user_id', auth()->id())->with('product')->get();
            $categories = Category::all();
            $products = Product::latest('id')->paginate(4);
            $admin =Auth::user();
            return view('front.profile',compact('admin','categories', 'products','carts'));

        }
        function profile_data(Request $request){

          $request->validate([
            'name'=>'required',
            'current_password'=>'required_with:password',
            'password'=>'nullable|min:8|confirmed',
          ]);

          /** @var User $admin */
          $admin=Auth::user();


          $data=[
            'name'=>$request->name,
          ];
          if($request->has('password')){
            $data['password']= bcrypt($request->password);
          }
          $admin->update($data);


            if($request->hasFile('image')){
                if($admin->image){
                    File::delete(public_path('image/'.$admin->image->path));
                    $admin->image()->delete();
                }
                $img_name=rand().time().$request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('images'),$img_name);
          //**لاختيار صورة واحدة */
                $admin->image()->create([
                    'path'=>$img_name
                ]);
            }



          return redirect()->back()->with('msg','Profile update successfuly');
        }
    }
