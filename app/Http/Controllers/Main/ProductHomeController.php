<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Services\ProductService;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ProductHomeController extends Controller
{
    protected $productService;
    protected $reviewService;

    public function __construct(ProductService $productService, ReviewService $reviewService)
    {
        $this->productService = $productService;
        $this->reviewService = $reviewService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productMore = $this->productService->more($id);
        $sizes = $this->productService->getSize();
        return view('main.product_detail', [
            'title'=>$product->name,
            'product'=>$product,
            'products'=>$productMore,
            'reviews' => $product->reviews,
            'sizes'=>$sizes
        ]);
    }

    //Đánh giá
    public function add_review(Request $request)
    {
        $this->reviewService->create_review($request);

        return redirect()->back();
    }

}
