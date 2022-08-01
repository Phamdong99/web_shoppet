<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductService
{
    public function getAll()
    {
        return Product::where('active','1')->get();
    }
    public function getCate()
    {
        return Category::where('active',1)->get();
    }

    protected function isValidPrice($request)
    {
        if($request->input('price') != 0 && $request->input('price_sale') != 0 && ($request->input('price_sale') >= $request->input('price')))
        {
            Session::flash('error','Giá giảm phải nhỏ hơn giá gốc. Vui lòng nhập lại');
            return false;
        }
        if($request->input('price') != 0 && $request->input('price_sale') == 0){

            Session::flash('error','Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }
    public function create($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false) return false;

        try{
            Product::create($request->all());
            Session::flash('success','Thêm mới sản phẩm thành công');

        }catch (\Exception $err) {

            Session::flash('error',$err->getMessage());
            return false;
        }

        return true;
    }
    public function update($request, $product){

        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice === false) return false;

        try{
            $product->name = (string)$request->input('name');
            $product->cate_id =(int)$request->input('cate_id');
            $product->price = (float)$request->input('price');
            $product->price_sale = (float)$request->input('price_sale');
            $product->file = (string)$request->input('file');
            $product->description = (string)$request->input('description');
            $product->content = (string)$request->input('content');
            $product->qty = (int)$request->input('qty');
            $product->active = (int)$request->input('active');
            $product->save();

            Session::flash('success', 'Thông báo bạn đã cập nhật sản phẩm thành công');
            return true;

        }catch (\Exception $err){

            Session::flash('error',$err->getMessage());
            return false;
        }

    }

    public function destroy($request){

        $id = (int)$request->input('id');

        $product = Product::find($id);
        if($product){
            return Product::where('id', $id)->delete();
        }
        return false;
    }

}
