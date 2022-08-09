<?php

namespace App\Services;

use App\Http\Requests\Cart\CreateFormRequest;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutService
{
    public function create($request)
    {
        if($request->input() != null){
            return true;
        }
        return false;
    }

    public function checkout()
    {
       $carts = Session::get('carts');
        if (is_null($carts)) return [];
//        Lấy id sản phẩm  từ cart
        $productId = array_keys($carts);

        return Product::where('active', 1)
            ->whereIn('id', $productId)
            ->get();

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
            Session::get('success', 'Bạn đã đặt hàng thành công');

            Session::flush();
            return $insert_cart;

        }catch (\Exception $err){
            throw $err;
            DB::rollBack();
            Session::get('error', $err->getMessage());
        }
        return false;
    }
    public function infoProductCart($carts, $customer_id)
    {
        $cart = Cart::create([
            'cus_id'=>$customer_id,
            'active' => 1,
            'total'=> 0
        ]);

        $total = 0;

//        Insert vào cart detail
        foreach ($carts as $key => $item){
            $product = $this->getDetailProduct($key);
            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
            $total += $price * $item;
            //số lượng còn lại
            $qty_pro = $product->qty - $item;

            $cart->cartdetails()->create([
                'qty'=> $item,
                'price'=> $price,
                'pro_id'=>$product->id,
                'cart_id'=>$cart->id
            ]);
            //update số lượng

            $cart->cartdetails[0]->products->update([
                'qty' => $qty_pro
            ]);
        }
        // insert vao bang cart
        $cart->update([
            'total' => $total
        ]);

        return $cart;
    }
    public function getDetailProduct($id)
    {
        return Product::where(['id' => $id, 'active' => 1])
            ->first();
    }
}
