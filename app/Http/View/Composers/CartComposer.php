<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CartComposer
{
    protected $users;

    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
//        load cart
        $carts = Session::get('carts');
        if(is_null($carts)) return[];

        $productId = array_keys($carts);
        $products = Product::where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $view->with('products', $products);

    }
}
