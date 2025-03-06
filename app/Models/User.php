<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'address',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function role(){
        return $this->belongsTo(roles::class)->withDefault();
    }

    function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    function reviews(){
        return $this->hasMany(Review::class);

    }
    function cart(){
        return $this->hasMany(Cart::class);

    }
    function orders(){
        return $this->hasMany(order::class);

    }
    function order_details(){
        return $this->hasMany(order_details::class);

    }

    function payments(){
        return $this->hasMany(payments::class);
    }

    function testimonials(){
        return $this->hasMany(testimonials::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class); // أو belongsToMany حسب التصميم
    }


}
