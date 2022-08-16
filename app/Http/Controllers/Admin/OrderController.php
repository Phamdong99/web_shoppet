<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Member;
use App\Services\CartService;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    protected $orderServices;

    public function __construct(CartService $orderServices)
    {
        $this->orderServices = $orderServices;
    }

    public function index()
    {
        return view('admin.orders.list', [
           'title'=>'Danh sách đơn hàng',
           'orders' => Customer::with('carts')->latest()->get()
        ]);
    }

    public function show(Cart $cart)
    {
        return view('admin.orders.show_detail', [
            'title'=>'chi tiết đơn hàng',
            'customer'=>$cart->customers,
            'carts'=>$cart->cartdetails,
            'total'=>$cart->total,
            'payment_method'=>$cart->payment_methods->name

        ]);
    }

    //update active
    public function update(Request $request)
    {
        $result = $this->orderServices->updateActive($request);
        if($result){
            return \response()->json([
                'error'=> false,
                'message'=>'Cập nhật đơn hàng thành công'
            ]);
        }
        return \response()->json([
            'error'=> true
        ]);
    }
}
