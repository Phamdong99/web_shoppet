<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.list',[
            'title'=>'Danh sách danh mục'
        ]);
    }
    public function create()
    {
        return view('admin.categories.add',[
            'title'=>'Thêm mới danh mục'
        ]);
    }
}
