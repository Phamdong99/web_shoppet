<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
      'cus_id',
      'active'
    ];

    public function cartdetails()
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'id');
    }
}
