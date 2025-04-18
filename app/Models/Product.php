<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,Trans;

    protected $guarded = [];

    function category(){

        return $this->belongsTo(Category::class)->withDefault();

    }
    function image() {
        return $this->morphOne(Image::class, 'imageable')
                    ->withDefault() // يعيد صورة افتراضية إذا لم تكن الصورة موجودة
                    ->where('type', 'main'); // تصفية الصور لتكون فقط من النوع 'main'
    }

    function gallery() {
        return $this->morphMany(Image::class, 'imageable')
                    ->where('type', 'gallery'); // تصفية الصور لتكون فقط من النوع 'gallery'
    }


    function reviews(){
        return $this->hasMany(Review::class);

    }
    function cart(){
        return $this->hasMany(Cart::class);

    }
    function order_details(){
        return $this->hasMany(order_details::class);

    }


    function getImgPathAttribute(){

        $url='https://via.placeholder.com/100x80';
        if($this->image){

            $url =asset('images/'.$this->image->path);

        }
        return $url;
    }

    public function variants()
{
    return $this->hasMany(product_variant::class);
}

}


