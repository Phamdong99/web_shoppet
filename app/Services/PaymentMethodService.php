<?php

namespace App\Services;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Session;

class PaymentMethodService
{
    public function getPayment()
    {
        return PaymentMethod::where('active', 1)->get();
    }
    public function create($request)
    {
        try {
            PaymentMethod::create([
                'name' => (string)$request->input('name'),
                'active'=> 1
            ]);

            Session::flash('success','Thông báo thêm mới thành công');
        }catch (\Exception $err)
        {
            Session::flash('error', $err->getMessage());
        }
    }
    public function destroy($request)
    {
        $id = (int)$request->input('id');
        if($id) {
            return PaymentMethod::where('active', 1)->where('id', $id)->delete();
        }
    }
}
