<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
       'name',
        'file',
        'description',
        'content',
        'active',
        'cate_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }
    public function menu(){
        return $this->hasOne(Category::class, 'id', 'cate_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'pro_id', 'id');
    }
    public function product_sizes()
    {
        return $this->hasMany(ProductSize::class, 'pro_id', 'id');
    }
}
