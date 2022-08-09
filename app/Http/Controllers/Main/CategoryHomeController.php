<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryHomeController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request, $id, $slug)
    {
//        check danh mục cha
        $category = $this->categoryService->getId($id);
//        load sp theo danh mục
        $products = $this->categoryService->getProduct($category, $request);

        return view('main.cate_product',[
           'title'=>$category->name,
            'products'=>$products,
            'category'=>$category
        ]);

    }

}
