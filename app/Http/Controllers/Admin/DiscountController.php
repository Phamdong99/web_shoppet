<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Services\DiscountSevice;
use http\Env\Response;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountSevice $discountService)
    {
        $this->discountService = $discountService;
    }
    public function index()
    {
        return view('admin.discounts.list', [
            'title'=>'Danh sách mã giảm giá',
            'discounts'=>Discount::where('active',1)->get()
        ]);
    }

    public function create()
    {
        return view('admin.discounts.add', [
            'title'=>'Thêm mã giảm giá'
        ]);
    }
    public function store(Request $request)
    {
        $this->discountService->create($request);
        return redirect('admin/discounts/list');
    }
    public function destroy(Request $request)
    {
       $result = $this->discountService->destroy($request);
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
