<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
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

    // علاقة مع المنتج
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }}
