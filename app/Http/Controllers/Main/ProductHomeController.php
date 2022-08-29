<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use App\Services\ProductService;
use App\Services\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductHomeController extends Controller
{
    protected $productService;
    protected $reviewService;

    public function __construct(ProductService $productService, ReviewService $reviewService)
    {
        $this->productService = $productService;
        $this->reviewService = $reviewService;
    }
    //js trả về id size để đổ giá theo size
    public function update_price_size(Request $request)
    {
        $size_id = $request->input('size_id');
        if($size_id){
            Session::put('size_id', $size_id);
        }
        $price_size = $this->productService->getPrice($size_id);
        return response()->json($price_size, 200);
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $price_size = $product->product_sizes;
        $productMore = $this->productService->more($id);
        $numbers = array_column($price_size->toArray(), 'price');
        $min = min($numbers);
        $max = max($numbers);

        return view('main.product_detail', [
            'title'=>$product->name,
            'product'=>$product,
            'products'=>$productMore,
            'reviews' => $product->reviews,
            'size_pros'=>$product->product_sizes,
            'product_qty' => $product->product_sizes,
            'min'=>$min,
            'max'=>$max
        ]);
    }

    //Đánh giá
    public function add_review(Request $request)
    {
        $this->reviewService->create_review($request);

        return redirect()->back();
    }

}
