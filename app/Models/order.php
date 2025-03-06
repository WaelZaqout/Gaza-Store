<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $guarded = [];
    

    function user(){
        return $this->belongsTo(User::class, 'user_id')->withDefault();

    }

    function order_details(){
        return $this->hasMany(order_details::class, 'order_id');

    }
    function payment(){
        return $this->hasOne(payments::class, 'order_id');
    }

        // علاقة مع الفواتير
        public function invoices()
        {
            return $this->hasMany(Invoice::class);
        }
}
