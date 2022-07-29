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
    public function getParent()
    {
        return Category::where('parent_id', 0)->get();
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

    public function update($category,$request)
    {
        if($category->parent_id != $category->id){
            $category->parent_id =(int)$request->input('parent_id');
        }
        $category->name = (string)$request->input('name');
        $category->file =(string)$request->input('file');
        $category->description =(string)$request->input('description');
        $category->content =(string)$request->input('content');
        $category->active =(int)$request->input('active');
        $category->save();

        Session::flash('success','Cập nhật sản phẩm thành công');
        return true;
    }
    public function destroy($request)
    {
        $id = $request->id;

        $category = Category::find($id);
        if($category){
            return Category::where('id', $id)->orwhere('parent_id', $id)->delete();
        }
        return false;
    }
}
