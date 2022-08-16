<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Member;
use App\Services\HistoryOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'title'=>'chi tiết đơn hàng',
                'customer'=>$cart->customers,
                'carts'=>$cart->cartdetails,
                'total'=>$cart->total,
                'payment_method'=>$cart->payment_methods->name
       ]);
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
