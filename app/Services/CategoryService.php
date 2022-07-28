<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryService
{
    public function getAll()
    {
        return Category::orderbyDesc('id')->paginate(10);
    }
    public function create($request)
    {
        try{
            Category::create([
                'name'=>(string)$request->input('name'),
                'parent_id'=>(int)$request->input('parent_id'),
                'file' =>(string)$request->input('file'),
                'description'=>(string)$request->input('description'),
                'content'=>(string)$request->input('content'),
                'active'=>(int)$request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);

            Session::flash('success', 'Thêm mới thành công');
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
}
