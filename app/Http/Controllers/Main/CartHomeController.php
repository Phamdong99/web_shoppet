<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartHomeController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
     $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $result = $this->cartService->create($request);
        if ($result === false) {
            return redirect()->back();
        }
        return redirect('/carts');

    }

    public function show()
    {
        $products = $this->cartService->getProduct();

        return view('main.carts.list', [
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'carts'=> Session::get('carts')
        ]);
    }
//cập nhật số lượng trong giỏ hàng
    public function update(Request $request)
    {
        $this->cartService->update($request);

        return redirect('/carts');

    }
//    GỠ BỎ SẢN PHẨM TRONG Gio HÀNG
    public function remove($id)
    {
        $this->cartService->remove($id);

        return redirect('/carts');

    }
}
