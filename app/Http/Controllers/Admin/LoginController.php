<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login', [
            'title'=>'Đăng nhập'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email'    => 'required|email:filter',
            'password' => 'required'

        ]);

        if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ], $request->input('remember')))
        {
            return redirect()->route('admin/main');
        }

        Session::flash('error','Email hoặc mật khẩu không chính xác, vui lòng đăng nhập lại');
        return redirect()->back();
    }
}
