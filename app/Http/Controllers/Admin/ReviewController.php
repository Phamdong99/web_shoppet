<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ReviewService;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(Product $product)
    {
        return view('admin.reviews.list_pro', [
           'title'=>'Danh sách sản phẩm được đánh giá',
            'list_pro_reviews'=>Product::get(),
            'review_details' => $product->reviews()->get()
        ]);
    }

    public function review_detail(Product $product)
    {
        return view('admin.reviews.review_detail', [
            'title'=>'Chi tiết đánh giá : '.$product->name,
            'product'=>$product,
            'review_details' => $product->reviews()->latest()->get()
        ]);
    }
}
