<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService=$sliderService;
    }
    public function index()
    {
        return view('admin.sliders.list', [
            'title'=>'Danh sách slider',
            'sliders'=>Slider::where('active',1)->get()
        ]);
    }
    public function create()
    {
        return view('admin.sliders.add', [
            'title'=>'Thêm slider'
        ]);
    }
    public function store(Request $request)
    {
        $this->sliderService->create($request);
        return redirect('admin/sliders/list');

    }
    public function show(Slider $slider)
    {
       return view('admin.sliders.edit', [
           'title'=>'Cập nhật slider',
           'slider'=>$slider
       ]);

    }

    public function update(Request $request, Slider $slider)
    {
        $this->sliderService->update($request, $slider);
        return redirect('admin/sliders/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->sliderService->destroy($request);
        if($result){
            return \response()->json([
                'error'=>false,
                'message'=>'Xoá slider thành công'
            ]);
        }
        return \response()->json([
            'error'=>true
        ]);
    }
}
