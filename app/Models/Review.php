<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'pro_id',
        'content',
        'name',
        'email',
        'active'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id', 'id');
    }
}
