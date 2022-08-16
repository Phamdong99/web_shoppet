<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone'
    ];
    public function carts()
    {
        //liên kết 1-n 1 khách hàng có nhiều lựa chọn
        return $this->hasMany(Cart::class, 'member_id', 'id');
    }
}
