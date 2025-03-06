<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products =Product::latest('id')->paginate(10);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =Category::select('id','name')->get();
        $product =new Product();


        return view('admin.products.create',compact('categories','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name_en'=>'required',
            'name_ar'=>'required',
            'image'=>'required',
            'gallery'=>'required',
            'price'=>'required',
            'description_en'=>'required',
            'description_ar'=>'required',
            'quantity'=>'required',
            'category_id'=>'required',
        ]);
        // $data=$request->except('_token','image','gallery');


        $product=Product::create([
            'name'=> '',
            'description'=> '',
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'category_id'=>$request->category_id,
        ]);


        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $img_name);

        $product->image()->create([
          'path' => $img_name,

        ]);
        foreach($request->gallery as $img){
            $img_name = rand().time(). $img->getClientOriginalName();
            $img->move(public_path('images'), $img_name);
            $product->image()->create([
              'path' => $img_name,
              'type' => 'gallery',

            ]);
        }
        return redirect()
        ->route('admin.products.index')
        ->with('msg','Product added Successfully')
        ->with('type','Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.products.edit', compact('product', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([

            'name_en'=>'required',
            'name_ar'=>'required',

            'price'=>'required',
            'description_en'=>'required',
            'description_ar'=>'required',
            'quantity'=>'required',
            'category_id'=>'required',
        ]);
        // $data=$request->except('_token','image','gallery');

        $product->update([
            'name'=> '',
            'descrizzzzzzption'=> '',
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'category_id'=>$request->category_id,
        ]);


        if($request->hasFile('image')){
            if($product->image){
                File::delete(public_path( 'images/' .$product->image->path));
            }
            $product->image()->delete();

            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $img_name);

            $product->image()->create([
                'path' => $img_name,
            ]);
        }

        if ($request->has('gallery')) {  // تأكد من استخدام اسم الحقل الصحيح هنا
            foreach ($request->gallery as $img) {
                $img_name = rand() . time() . $img->getClientOriginalName();
                $img->move(public_path('images'), $img_name);
                $product->image()->create([
                    'path' => $img_name,
                    'type' => 'gallery',
                ]);
            }
        }
        return redirect()
        ->route('admin.products.index')
        ->with('msg','Product added Successfully')
        ->with('type','Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        File::delete(public_path( 'images/' .$product->image->path));

        foreach($product->gallery as $img){
        File::delete(public_path( 'images/' .$img->path));

        }
        $product->image()->delete();
        $product->gallery()->delete();
        $product->delete();

        return redirect()
        ->route('admin.products.index')
        ->with('msg','Product deleted Successfully')
        ->with('type','info');
}

        function delete_img($id){
            $img =Image::find($id);
            File::delete(public_path( 'images/' .$img->path));

            return Image::destroy($id);

        }
            // public function getProducts(Request $request){

            //     $categoryId = $request->category_id;

            //     // جلب المنتجات بناءً على القسم المحدد
            //     if ($categoryId == 'all') {
            //         $products = Product::latest()->limit(12)->get();
            //     } else {
            //         $products = Product::where('category_id', $categoryId)->latest()->limit(12)->get();
            //     }

            //     return view('front.partials.products', compact('products'));
            // }

}
