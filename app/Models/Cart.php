<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['total_price', 'user_id','status'];

    function products() {
        return $this->belongsToMany(Product::class)->withPivot('amount','price');
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
