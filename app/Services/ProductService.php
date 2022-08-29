<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\Session;
use Termwind\Components\Li;

class ProductService
{
//    admin
    public function getAll()
    {
        return Product::latest()->get();
    }
    public function getCate()
    {
        return Category::where('active',1)->get();
    }

//    protected function isValidPrice($request)
//    {
//        if($request->input('price') != 0 && $request->input('price_sale') != 0 && ($request->input('price_sale') >= $request->input('price')))
//        {
//            Session::flash('error','Giá giảm phải nhỏ hơn giá gốc. Vui lòng nhập lại');
//            return false;
//        }
//        if($request->input('price') == 0 && $request->input('price_sale') != 0){
//
//            Session::flash('error','Vui lòng nhập giá gốc');
//            return false;
//        }
//        return true;
//    }
    public function create($request)
    {
        $sizes = $request->input('size');
        $price = $request->input('price');
        $qty = $request->input('qty');

//        $isValidPrice = $this->isValidPrice($request);
//        if($isValidPrice === false) return false;
        try{
            $product = Product::create([
                'name'=>$request->input('name'),
                'file'=>$request->input('file'),
                'description'=>$request->input('description'),
                'content'=>$request->input('content'),
                'active'=>$request->input('active'),
                'cate_id'=>$request->input('cate_id')
            ]);

            //insert vào bảng size
            $this->inforProductSize($sizes,$product->id,$price,$qty);

            Session::flash('success','Thêm mới sản phẩm thành công');

        }catch (\Exception $err) {
            throw $err;
            Session::flash('error',$err->getMessage());
            return false;
        }

        return true;
    }
    public function inforProductSize($sizes,$product_id,$price,$qty)
    {
        if(isset($sizes)){
            foreach ($sizes as $key => $size){
                $sizes = Size::create([
                    'size'=>$size,
                    'active' => 1
                ]);

                $sizes->product_sizes()->create([
                    'size_id'=>$sizes->id,
                    'pro_id' =>$product_id,
                    'price'=> $price[$key],
                    'qty' => $qty[$key],
                    'active' => 1
                ]);
            }
        }
    }
    public function update($request, $product){

//        $isValidPrice = $this->isValidPrice($request);
//        if($isValidPrice === false) return false;

        try{
            $product->name = (string)$request->input('name');
            $product->cate_id =(int)$request->input('cate_id');
//            $product->price = (float)$request->input('price');
//            $product->price_sale = (float)$request->input('price_sale');
            $product->file = (string)$request->input('file');
            $product->description = (string)$request->input('description');
            $product->content = (string)$request->input('content');
//            $product->qty = (int)$request->input('qty');
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
//    Main Home

//  load product
    const LIMIT = 16;
    public function get($page = null)
    {
        return Product::orderbyDesc('id')
            ->where('active', 1)
            ->when($page != null, function ($query) use ($page) {
                $offset = $page * self::LIMIT;
                $query->offset($offset);
            })
            ->limit(self::LIMIT)
            ->get();
    }

//    Lấy ra thông tin chi tiết sản phẩm
    public function show($id)
    {
        return Product::where('id',$id)
            ->where('active', 1)
            ->with('menu')
            ->with('product_sizes')
            -> firstOrFail();
    }

    //lấy ra sp liên quan
    public function more($id)
    {
        return Product::where('active', 1)
            ->where('id','!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->with('menu')
            ->get();
    }

    public function getPrice($size_id)
    {
        return ProductSize::where('size_id', $size_id)->get();
    }
}
