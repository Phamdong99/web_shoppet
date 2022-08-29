<?php

namespace App\Services;

use App\Models\Transport;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;

class TransportService
{

    public function getTran()
    {
        return Transport::get();
    }
    public function create($request)
    {
        try {
            Transport::create($request->all());
            Session::flash('success','Thêm mới thành công');
        }catch (Exception $err)
        {
            Session::flash('error',$err->getMessage());
        }

    }
    public function destroy($request)
    {
        $id = $request->input('id');
        if($id)
        {
            return Transport::where('id', $id)->delete();
        }
        return false;
    }
}
