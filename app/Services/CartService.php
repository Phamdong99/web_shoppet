<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartService
{
    //insert phía khách hàng
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('pro_id');
        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');
        //kiểm tra xem có sp trong giỏ hàng chưa.nếu chưa ta tạo ra giỏ hàng
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }
        //ngược lại ta cập nhật số lượng cũ
        //arr:exists de lay ra cai id
        $exists = Arr::exists($carts, $product_id);
//        Kiểm tra xem đã có sản phẩm đấy trong giỏ hàng chưa
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            dd( $carts[$product_id]);
            //update session
            Session::put('carts', $carts);
            return true;
        }
        $carts[$product_id] = $qty;
        Session::put('carts', $carts);
        return true;
    }

    public function getProduct()
    {
//        Lấy thông tin từ cart về
        $carts = Session::get('carts');
        if (is_null($carts)) return [];
//        Lấy id sản phẩm  từ cart
        $productId = array_keys($carts);
        return Product::where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }

//    update số lượng sản phẩm trong giỏ hàng
    public function update($request)
    {

        $numArr = $request->input('num_product');
        $idArr = $request->input('product_id');

        $carts = Session::get('carts');

        foreach ($idArr as $product_id) {
            if (isset($carts[$product_id])) {
                $carts[$product_id] = $numArr[$product_id];
            }
        }
        Session::put('carts', $carts);
        return true;
    }

//    gỡ bỏ sản phẩm trong giỏ hàng

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }
}
