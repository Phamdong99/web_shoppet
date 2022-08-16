<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService=$memberService;
    }

    public function index()
    {
        $members = $this->memberService->getMembers();
        return view('admin.members.list', [
            'title'=>'Danh sách thành viên',
            'members'=>$members
        ]);
    }
    public function destroy(Request $request)
    {
        $result = $this->memberService->destroy($request);
        if($result)
        {
           return response()->json([
                'error'=>false,
                'message'=>'Xóa thành viên thành công'
            ]);
           return response()->json([
                'error'=>true
            ]);
        }

    }
}
