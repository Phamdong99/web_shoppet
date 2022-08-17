<?php

namespace App\Services;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutService
{

    public function getPay()
    {
        return PaymentMethod::where('active', 1)->get();
    }

    //Lưu cart vào db
    public function addCart($request)
    {
//        $view_cart = Session::get('carts');
//        $carts = $request->input('cart_item');
//        var_dump($carts);
//        var_dump($view_cart);
//        dd();
        $member_id = (int)$request->input('member_id');
        $pay_id = (int)$request->input('pay_id');
        try {
            DB::beginTransaction();//khi chạy try mà gặp lỗi thì commit để tránh bị dư dữ liệu
            $carts = $request->input('cart_item');

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

//          Insert vào db cart
            $insert_cart = $this->infoProductCart($carts, $customer->id, $pay_id, $member_id);
            DB::commit();

            Session::flash('success', 'Bạn đã đặt hàng thành công');

            //queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            //lấy về giỏ hàng
            $view_cart = Session::get('carts');
//            Update cart
            foreach ($carts as $key => $item) {
                //kiểm tra key có nằm trong view_cart hay không
                if (array_key_exists($key,$view_cart)) {
//                    Nếu có unset xóa sau khi thanh toán thành công
                   unset($view_cart[$key]);
                }
            }
            Session::put('carts', $view_cart);

            return $insert_cart;

        }catch (\Exception $err){
            DB::rollBack();
            Session::flash('error', $err->getMessage());
        }
        return false;
    }
    public function infoProductCart($carts, $customer_id, $pay_id, $member_id)
    {

        $cart = Cart::create([
            'cus_id'=>$customer_id,
            'active' => 1,
            'total'=> 0,
            'pay_id'=>$pay_id,
            'member_id'=>$member_id
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
