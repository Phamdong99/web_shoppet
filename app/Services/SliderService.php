<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;

class SliderService
{
    public function create($request)
    {

        try{
            Slider::create($request->all());

            Session::flash('success','Thông báo thêm mới thành công');
            return true;
        }catch (\Exception $err)
        {

            Session::flash('error',$err->getMessage());
            return false;
        }

    }

    public function update($request, $slider)
    {
        try {
            $slider->fill($request->input());
            $slider->save();

            Session::flash('success','Thông báo cập nhật slider thành công');
            return true;
        }catch (\Exception $err)
        {
            Session::flash('error','Thông báo cập nhật lỗi');
            return false;
        }

    }

    public function destroy($request){

        $id = $request->input('id');
        $slider = Slider::find($id);
        if($slider){
            return Slider::where('id', $id)->delete();
        }
        return false;
    }
}
