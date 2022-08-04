<?php

namespace App\Services;

use App\Models\Size;
use Illuminate\Support\Facades\Session;

class SizeService
{
    public function getAll()
    {
        return Size::get();
    }
    public function create($request)
    {
        try {
            Size::create($request->all());
            Session::flash('success','Thông báo thêm size thành công');
            return true;
        }catch (\Exception $err) {
            throw $err;
            Session::flash('error','Thông báo thêm mới không thành công');
            return false;
        }
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $size = Size::find($id);
        if($size)
        {
            return Size::where('id', $id)->delete();
        }
        return false;
    }
}
