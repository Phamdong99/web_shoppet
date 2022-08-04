<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

class ProductHomeController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productMore = $this->productService->more($id);
        return view('main.product_detail', [
            'title'=>$product->name,
            'product'=>$product,
            'products'=>$productMore
        ]);
    }
}
