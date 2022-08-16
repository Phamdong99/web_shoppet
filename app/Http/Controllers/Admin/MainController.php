<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Member;
use App\Models\Product;
use App\Models\Review;

class MainController extends Controller
{
    public function index()
    {
        $cart_month = Cart::whereMonth('created_at', date('m'))->get();
        return view('admin.home',[
            'title'=>'Trang chủ',
            'orders' => Customer::with('carts')->latest()->paginate(10),
            'total_cart_of_month' => Cart::whereMonth('created_at', date('m'))->count(),
            'total_of_month' => collect($cart_month)->where('active', 4)->sum('total'),
            'members'=>Member::get(),
            'product'=>Product::where('active', 1)->get(),
            'reviews'=>Review::with('product')->latest()->paginate(10)
        ]);
    }
}
