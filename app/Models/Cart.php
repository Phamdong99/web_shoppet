<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
      'cus_id',
      'active',
        'total',
        'pay_id',
        'member_id'
    ];

    public function cartdetails()
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'id');
    }

    public function customers()
    {
        //liên kết 1-n 1 khách hàng có nhiều lựa chọn
        return $this->belongsTo(Customer::class, 'cus_id', 'id');
    }

    public function payment_methods()
    {

        return $this->belongsTo(PaymentMethod::class, 'pay_id', 'id');
    }

}
