<?php

namespace App\Services;

use App\Models\Discount;
use Illuminate\Support\Facades\Session;

class DiscountSevice
{
    public function create($request)
    {
        try {
            Discount::create([
                'name'=>$request->input('name'),
                'discount'=>$request->input('discount'),
                'active'=>1
            ]);

            Session::flash('success', 'Thông báo thêm mới thành công');
        }catch (\Exception $err)
        {
            throw $err;
            Session::flash('error', $err->getMessage());
        }
    }
    public function destroy($request)
    {
        $id = $request->input('id');
        if ($id){
            return Discount::where('id',$id)->delete();
        }
        return false;
    }
}
