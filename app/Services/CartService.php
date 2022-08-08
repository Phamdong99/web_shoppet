<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
        //arr:exists de lay ra cai id xem nó có tồn tại trong giỏ hàng k
        $exists = Arr::exists($carts, $product_id);
     //        Kiểm tra xem đã có sản phẩm đấy trong giỏ hàng chưa
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
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

    //Lưu cart vào db
    public function addCart($request)
    {
        try {
            DB::beginTransaction(); //khi chạy try mà gặp lỗi thì commit để tránh bị dư dữ liệu

            $carts = Session::get('carts');
            if(is_null($carts)) return false;

//           Insert vào db customer

            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email'=> $request->input('email'),
                'content' => $request->input('content'),
                'active' => $request->input(1)
            ]);

//            Insert vào db cart
            $insert_cart = $this->infoProductCart($carts, $customer->id);
            DB::commit();
            Session::get('success', 'Đặt hàng thành công');
//            Session::flush();
            return $insert_cart;

        }catch (\Exception $err){
            DB::rollBack();
            Session::get('error', $err->getMessage());
        }
        return false;
    }
    public function infoProductCart($carts, $customer_id)
    {
        $cart = Cart::create([
            'cus_id'=>$customer_id,
            'active' => 1
        ]);

//        $total = 0;
//        Insert vào cart detail
        foreach ($carts as $key => $item){
            $product = $this->getDetailProduct($key);
//            $qty_pro = $product->qty - $item;
            $cart->cartdetails()->create([
                'qty'=> $item,
                'pro_id'=>$product->id,
                'cart_id'=>$cart->id
            ]);
//            //update số lượng
//
//            $cart->cart_details[0]->products->update([
//                'qty' => $qty_pro
//            ]);
        }
    }
    public function getDetailProduct($id)
    {
        return Product::where(['id' => $id, 'active' => 1])
            ->first();
    }
}
