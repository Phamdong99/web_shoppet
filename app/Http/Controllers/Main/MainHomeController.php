<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SliderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainHomeController extends Controller
{

    protected $sliderService;
    protected $categoryService;
    protected $productService;

    public function __construct(SliderService $sliderService, CategoryService $categoryService, ProductService $productService)
    {
        $this->sliderService = $sliderService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;

    }

    public function index()
    {

       return view('main.home', [
           'title'=>'Trang chủ',
           'sliders'=>$this->sliderService->show(),
           'categories'=>$this->categoryService->showCate(),
           'products'=>$this->productService->getAll()
       ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);

        $result = $this->productService->get($page);

        if (count($result) != 0) {
            //chuyền vào view 1 cái biến product và biến này sẽ chứa data và sau đó render ra view
            $html = view('main.product', ['product' => $result])->render();

            return response()->json([
                'html' => $html
            ]);
        }
        return response()->json([
            'html' => ''
        ]);
    }

    #tìm kiếm sản phẩm
    public function search(Request $request)
    {
        $product = Product::where('name','like','%'.$request->search.'%')->get();
        return view('main.search', [
            'title'=>'Tìm kiếm',
            'products'=>$product
        ]);
    }

    #show chi tiết sản phẩm
    public function show_pro_detail(Request $request)
    {
//        $id_pro_detail = $request->input('id_pro_detail');
//        $pro_details = Product::where('id',$id_pro_detail)
//            ->where('active', 1)
//            ->with('menu')
//            -> firstOrFail();
//        return view('main.pro_detail_view', [
//            'pro_details'=>$pro_details
//        ]);
    }
}
