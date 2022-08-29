<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
      'pro_id',
        'size_id',
        'price',
        'qty',
        'active'
    ];

    public function sizes()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
