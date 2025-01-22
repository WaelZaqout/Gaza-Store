<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{


    public function addToFavorite(Request $request)
    {
        $productId = $request->input('product_id');

        // تحقق من وجود المنتج
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // إضافة المنتج إلى المفضلة
        $favorite = Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $productId,
        ]);

        if ($favorite->wasRecentlyCreated) {
            return response()->json(['message' => 'Product added to favorites successfully.']);
        } else {
            return response()->json(['message' => 'Product is already in your favorites.']);
        }
    }
    public function removeFromfavorites($id)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('id', $id) // التحقق من ID المفضل
            ->first();

        if ($favorite) {
            $favorite->delete(); // حذف المنتج
            return response()->noContent(); // إعادة استجابة بدون محتوى
        }

        return response()->json(['message' => 'لم يتم العثور على العنصر.'], 404); // إذا لم يتم العثور عليه
    }

    public function toggleFavorite(Request $request)
    {
        $productId = $request->input('product_id');

        // تحقق من وجود المنتج
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // التحقق مما إذا كان المنتج في المفضلة
        $favorite = Favorite::where([
            'user_id' => auth()->id(),
            'product_id' => $productId,
        ])->first();

        if ($favorite) {
            // حذف المنتج من المفضلة
            $favorite->delete();
            return response()->json(['message' => 'Product removed from favorites.', 'status' => 'removed']);
        } else {
            // إضافة المنتج إلى المفضلة
            Favorite::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);
            return response()->json(['message' => 'Product added to favorites successfully.', 'status' => 'added']);
        }
    }

    public function isFavorite(Request $request)
    {
        $productId = $request->input('product_id');

        $isFavorite = Favorite::where([
            'user_id' => auth()->id(),
            'product_id' => $productId,
        ])->exists();

        return response()->json(['isFavorite' => $isFavorite]);
    }

    // عرض صفحة المفضلة
    public function favoritesPage()
    {
        // جلب العناصر المفضلة وعددها
        $favorites = Auth::user()->favorites; // يفترض أن لديك علاقة مفضلة مع المستخدم
        $favoritesCount = $favorites->count(); // حساب عدد المفضلات
        $categories = Category::all();

        // تمرير البيانات إلى العرض
        return view('front.favorites', compact('favorites', 'favoritesCount','categories'));
    }

    // API لاسترجاع عدد المفضلات (في حال احتجت لاستخدام AJAX)
    public function getFavoritesCount()
    {
        $favoritesCount = Auth::user()->favorites->count(); // حساب العدد
        return response()->json(['count' => $favoritesCount]);
    }
}
