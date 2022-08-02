<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id',
        'file',
        'description',
        'content',
        'active',
        'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'cate_id', 'id');
    }
}
