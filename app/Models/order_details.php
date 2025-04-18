<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    
    use HasFactory;

    protected $guarded = [];

    function user(){
        return $this->belongsTo(User::class)->withDefault();

    }
    function product(){
        return $this->belongsTo(Product::class)->withDefault();

    }
    function order(){
        return $this->belongsTo(order::class)->withDefault();

    }
    function payment(){
        return $this->hasOne(payments::class, 'order_id');
    }


}
