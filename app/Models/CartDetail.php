<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'pro_id',
        'cart_id',
        'price'
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'pro_id', 'id');
    }
}
