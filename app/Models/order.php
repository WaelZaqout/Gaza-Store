<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $guarded = [];


    function users(){
        return $this->belongsTo(User::class)->withDefault();

    }

    function order_details(){
        return $this->hasMany(order_details::class);

    }
    function payments(){
        return $this->hasOne(payments::class);
    }
}
