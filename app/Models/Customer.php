<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory,Trans;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * علاقة العميل مع الطلبات (Customer has many Orders)
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }


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

    /**
     * التحقق مما إذا كان العميل نشطًا
     */
    public function isActive()
    {
        return $this->status === 'active';
    }
}
