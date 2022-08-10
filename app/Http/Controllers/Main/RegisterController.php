<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\MemberService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $memberService;
    public function __construct(MemberService $memberService)
    {
        $this->memberService=$memberService;
    }

    public function register()
    {
        return view('main.register', [
            'title'=>'Đăng ký tài khoản'
        ]);
    }

    public function create_register(Request $request)
    {

        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|unique:members,email',
            'password'=>'required|confirmed',
            'address'=>'required',
            'phone'=>'required'
        ]);

        $this->memberService->create_register($request);
        return redirect('member/login');
    }
}
