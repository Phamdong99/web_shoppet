<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateFormRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
        return redirect()->back();
    }

    public function show(Product $product)
    {
        return view('admin.products.edit', [
           'title'=>'Cập nhật sản phẩm',
            'product'=>$product,
            'categories'=>$this->productService->getCate()

        ]);
    }
    public function update(CreateFormRequest $request, Product $product)
    {
       $this->productService->update($request, $product);
       return redirect('admin/products/list');
    }

    public function destroy(Request $request)
    {

       $result = $this->productService->destroy($request);

        if($result){
            return \response()->json([
                'error'=>false,
                'message'=>'Xoá danh mục thành công'
            ]);
        }
        return \response()->json([
            'error'=>true
        ]);
    }
}
