<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateFormRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index()
    {
        $products = Product::with('product_sizes.sizes')->latest()->get();

        return view('admin.products.list',[
           'title'=>'Danh sách sản phẩm',
            'products'=>$products,

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
        if($request->input('cate_id') != 0){
            $this->productService->create($request);
            return redirect()->back();
        }else{
            \Illuminate\Support\Facades\Session::flash('error', 'Vui lòng chọn danh mục cho sản phẩm');
            return redirect()->back();
        }

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
                'message'=>'Xoá sản phẩm thành công'
            ]);
        }
        return \response()->json([
            'error'=>true
        ]);
    }
}
