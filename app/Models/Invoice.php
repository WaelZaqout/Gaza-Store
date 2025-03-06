<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory,Trans;

    protected $guarded = [];

    function category(){

        return $this->belongsTo(Category::class)->withDefault();

    }

    function payment(){
        return $this->hasOne(payments::class);
    }



    public function customer()
        {
            return $this->belongsTo(Customer::class, 'user_id');
        }


    function order_details(){
        return $this->hasMany(order_details::class);

    }

    // العلاقة مع جدول الطلبات
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // العلاقة مع جدول المستخدمين
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // دالة لحساب الإجمالي بعد الخصم والضريبة
    public function calculateTotal()
    {
        $discountedAmount = $this->amount_collection - $this->discount;
        $vatAmount = ($discountedAmount * $this->value_vat) / 100;
        $total = $discountedAmount + $vatAmount;

        return $total;
    }

    // دالة لتغيير حالة الفاتورة
    public function setStatus($status)
    {
        $this->status = $status;
        $this->value_status = ($status == 'paid') ? 1 : 0;
        $this->save();
    }
    function getImgPathAttribute(){

        $url='https://via.placeholder.com/100x80';
        if($this->image){

            $url =asset('images/'.$this->image->path);

        }
        return $url;
    }

}


