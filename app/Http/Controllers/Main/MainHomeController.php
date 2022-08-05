<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SliderService;
use Illuminate\Http\Request;

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
            $html = view('main.product', ['product' => $result])->render();

            return response()->json([
                'html' => $html
            ]);
        }
        return response()->json([
            'html' => ''
        ]);
    }
}
