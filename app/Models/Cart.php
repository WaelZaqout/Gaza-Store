<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory,Trans;

    protected $guarded = [];

    function users(){
        return $this->belongsTo(User::class)->withDefault();

    }



    // حساب الإجمالي مباشرة
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    function image() {
        return $this->morphOne(Image::class, 'imageable')
                    ->withDefault() // يعيد صورة افتراضية إذا لم تكن الصورة موجودة
                    ->where('type', 'main'); // تصفية الصور لتكون فقط من النوع 'main'
    }

    // علاقة مع المنتج
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

}


