<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TransportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransportController extends Controller
{
    protected $transportService;

    public function __construct(TransportService $transportService)
    {
        $this->transportService = $transportService;
    }

    public function index()
    {
        $transport = $this->transportService->getTran();
        return view('admin.transports.list', [
           'title'=>'Danh sách PTVC',
            'transports' => $transport
        ]);
    }

    public function create()
    {
        return view('admin.transports.add', [
            'title'=>'Thêm PTVC'
        ]);
    }
    public function store(Request $request)
    {
        $this->transportService->create($request);
        return redirect('admin/transports/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->transportService->destroy($request);
        if($result)
        {
            return response()->json([
               'error' => false,
               'message' => 'Thông báo xóa thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
