<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Services\SizeService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    protected $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    public function index()
    {
        return view('admin.sizes.list', [
           'title'=>'Danh sách size',
            'sizes'=>$this->sizeService->getAll()
        ]);
    }

    public function create()
    {
        return view('admin.sizes.add', [
            'title'=>'Thêm size'
        ]);
    }

    public function store(Request $request)
    {
        $this->sizeService->create($request);
        return redirect('admin/sizes/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->sizeService->destroy($request);

        if($result){
            return \response()->json([
                'error'=>false,
                'message'=>'Xoá thành công'
            ]);
        }
        return \response()->json([
            'error'=>true
        ]);
    }

}
