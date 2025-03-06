<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;

    protected $guarded = [];

    function users(){
        return $this->belongsTo(User::class)->withDefault();

    }

    function order(){
        return $this->belongsTo(order::class)->withDefault();

    }

     // علاقة مع الفواتير
     public function invoices()
     {
         return $this->hasMany(Invoice::class);
     }
}
