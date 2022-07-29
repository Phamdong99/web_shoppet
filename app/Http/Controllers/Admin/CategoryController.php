<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateFormRequest;
use App\Models\Category;
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
            'title'=>'Thêm mới danh mục',
            'categories'=>$this->categoryService->getParent()
        ]);
    }
    public function store(CreateFormRequest $request)
    {
        $this->categoryService->create($request);
        return redirect('admin/categories/list');
    }
    public function show(Category $category)
    {
        return view('admin.categories.edit',[
            'title'=>'Sửa danh mục : '.$category->name,
            'category'=>$category,
            'categories'=>$this->categoryService->getParent()
        ]);
    }
    public function update(Category $category, CreateFormRequest $request)
    {
        $this->categoryService->update($category,$request);
        return redirect('admin/categories/list');
    }
    public function destroy(Request $request)
    {
        $result = $this->categoryService->destroy($request);

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
