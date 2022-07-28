<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.categories.list',[
            'title'=>'Danh sách danh mục',
            'categories'=>$this->categoryService->getAll()
        ]);
    }
    public function create()
    {
        return view('admin.categories.add',[
            'title'=>'Thêm mới danh mục'
        ]);
    }
    public function store(Request $request)
    {
        $this->categoryService->create($request);
        return redirect()->back();
    }
}
