<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateFormRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index()
    {
        return view('admin.products.list', [
           'title'=>'Danh sách sản phẩm',
            'products'=>$this->productService->getAll()
        ]);
    }
    public function create()
    {
        return view('admin.products.add', [
           'title'=>'Thêm sản phẩm',
            'products'=>$this->productService->getCate()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $this->productService->create($request);
        return redirect('admin/products/list');
    }
}
