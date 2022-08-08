<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'phone',
      'address',
      'email',
      'content',
        'active'
    ];

    public function carts()
    {
        //liên kết 1-n 1 khách hàng có nhiều lựa chọn
        return $this->hasMany(Cart::class, 'cus_id', 'id');
    }
}
