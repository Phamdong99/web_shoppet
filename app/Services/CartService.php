<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartService
{
    //insert phía khách hàng
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('pro_id');
        $size_id = (int)$request->input('size_id');
        $size = Size::where('id',$size_id)->with(['product_sizes'=>function($q)use($product_id){
            $q->where('pro_id',$product_id);
        }])->first();
        $price_size = $size->product_sizes;
        $price = $price_size[0]->price;
        $label = $size->size;
//        $price_size = ProductSize::where('size_id',$size_id)->first();
//        $size = Size::where('id',$size_id)->first();
//        $price = $price_size->price;
//        $label = $size->size;
        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng, size hoặc sản phẩm không chính xác');
            return false;
        }
        $carts = Session::get('carts');
        //kiểm tra xem có sp trong giỏ hàng chưa.nếu chưa ta tạo ra giỏ hàng
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => [
                    $size_id => [
                        'qty' => $qty,
                        'price'=>$price,
                        'label' => $label
                    ]
                ]
            ]);
            return true;
        } else {

            //ngược lại ta cập nhật số lượng cũ
            //arr:exists de lay ra cai id xem nó có tồn tại trong giỏ hàng k
            $exists = Arr::exists($carts, $product_id);
            // Kiểm tra xem đã có sản phẩm đấy trong giỏ hàng chưa
            if ($exists) {
                $exists1 = Arr::exists($carts[$product_id], $size_id);
                if ($exists1) {
                    $carts[$product_id][$size_id]['qty'] = $carts[$product_id][$size_id]['qty'] + $qty;
                    //update session
                    Session::put('carts', $carts);
                return true;
                } else {

                    $carts[$product_id][$size_id]['qty'] = $qty;
                    $carts[$product_id][$size_id]['price'] = $price;
                    $carts[$product_id][$size_id]['label'] = $label;

                    Session::put('carts', $carts);
                    return true;
                }
            }else{

                $carts[$product_id][$size_id]['qty'] = $qty;
                $carts[$product_id][$size_id]['price'] = $price;
                $carts[$product_id][$size_id]['label'] = $label;

                Session::put('carts', $carts);
                return true;
            }
        }
    }


    public function getProduct()
    {
//      Lấy thông tin từ cart về
        $carts = Session::get('carts');
        if (is_null($carts)) return [];
//        Lấy id sản phẩm  từ cart
        $productId = array_keys($carts);

        return Product::where('active', 1)
            ->whereIn('id', $productId)
            ->with('product_sizes.sizes')
            ->get();
    }

//    update số lượng sản phẩm trong giỏ hàng
    public function update($request)
    {
        $numArr = $request->input('num_product');

        $idArr = $request->input('product_id');
        $carts = Session::get('carts');

        foreach ($idArr as $product_id) {
            foreach ($carts[$product_id] as $product_cart){
                if (isset($product_cart['qty'])) {
                    $product_cart['qty'] = $numArr[$product_id];
                }
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

    //update active order
    public function updateActive($request)
    {

        $active = (int)$request->input('active');
        $cart_id = (int)$request->input('cart_id');
        $cart = Cart::where('id', $cart_id)->first();

        if($cart)
        {
            return Cart::where('id', $cart_id)->update(['active' => $active]);
        }
        return false;
    }

}
