<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Silder extends Model
{
    use HasFactory ,Trans;

    protected $guarded = [];

    function cart(){
        return $this->hasMany(Cart::class);

    }

    function image() {
        return $this->morphOne(Image::class, 'imageable')
                    ->withDefault() // يعيد صورة افتراضية إذا لم تكن الصورة موجودة
                    ->where('type', 'main'); // تصفية الصور لتكون فقط من النوع 'main'
    }




    function getImgPathAttribute(){

        $url='https://via.placeholder.com/100x80';
        if($this->image){
            $url =asset('images/'.$this->image->path);
        }
        return $url;
    }
}
