<?php

namespace App\Models;

use App\Traits\Trans;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,Trans;

    protected $guarded = [];

    function products(){
        return $this->hasMany(Product::class);

    }
    function image(){
        return $this->morphOne(Image::class,'imageable');

    }

    function getImgPathAttribute(){

        $url='https://via.placeholder.com/100x80';
        if($this->image){

            $url =asset('images/'.$this->image->path);

        }
        return $url;
    }

}

