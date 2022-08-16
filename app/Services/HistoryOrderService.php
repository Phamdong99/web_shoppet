<?php

namespace App\Services;


use App\Models\Cart;
use MongoDB\Driver\Session;

class HistoryOrderService
{
    public function updateActive($cart, $request)
    {
        $id = (int)$request->input('id');
        if($id)
        {
            return Cart::where('id', $id)->update([
                'active'=> 5
            ]);
        }
        return false;

    }
}
