<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOut\CreateFormRequest;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function index(Request $request)
    {
        $result = $this->checkoutService->create($request);
        if($result === true){
            return redirect('/checkout');
        }
        return redirect()->back();

    }

    public function checkout()
    {
        $products = $this->checkoutService->checkout();
        return view('main.check_out', [
            'title' => 'Trang thanh toán',
            'products' => $products,
            'carts'=> Session::get('carts')
        ]);
    }

    public function addCart(CreateFormRequest $request)
    {
        $result = $this->checkoutService->addCart($request);
        if($result){
            return view('main.carts.history_order',[
                'title'=> 'Lịch sử đặt hàng'
            ]);
        }
        return redirect()->back();

    }

}
