<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Member;
use App\Services\HistoryOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class HistoryOrderController extends Controller
{
    protected $history;

    public function __construct(HistoryOrderService $history)
    {
        $this->history = $history;
    }

    public function history_order()
    {
        $id_member = Auth::guard('member')->user()->id;
        $member = Member::where('id', $id_member)->get();
        $orders = Cart::where('member_id', $id_member)->latest()->get();
        return view('main.carts.history_order', [
            'title'=>'Lịch sử đơn hàng',
            'members'=>$member,
            'orders'=>$orders
        ]);
    }

    public function show_detail_order(Cart $cart)
    {
       return view('main.carts.history_order_detail', [
                'title'=>'Chi tiết đơn hàng',
                'customer'=>$cart->customers,
                'carts'=>$cart->cartdetails,
                'total'=>$cart->total,
                'cart_content'=>$cart,
                'payment_method'=>$cart->payment_methods->name
       ]);
    }

    public function return_goods_order(Cart $cart, Request $request)
    {
        return view('main.carts.return_goods', [
            'title'=>'Hoàn trả đơn hàng',
            'customer'=>$cart->customers,
            'carts'=>$cart->cartdetails,
            'total'=>$cart->total,
            'id_cart'=>$cart,
            'payment_method'=>$cart->payment_methods->name
        ]);
    }

    public function return_goods(Cart $cart, Request $request)
    {
        $result = $this->history->updateActive1($cart, $request);
        $IdProduct = $request->id_product;

        if($result){
            return response()->json($IdProduct, 200);
        }
    }


    public function update_active(Cart $cart, Request $request)
    {
        $result = $this->history->updateActive($cart, $request);

        if($result){
            return \response()->json([
                'error'=>false,
                'message'=>'Hủy đơn hàng thành công'
            ]);
        }
        return \response()->json([
            'error'=>true
        ]);
    }
}
