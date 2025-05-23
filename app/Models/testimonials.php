<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimonials extends Model
{
    use HasFactory;

    protected $guarded = [];

    function users(){
        return $this->belongsTo(User::class)->withDefault();

    }

}
