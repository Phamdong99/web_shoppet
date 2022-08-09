<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginHomeController extends Controller
{
    public function index()
    {
        return view('main.login', [
            'title'=>'Đăng nhập thành viên'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'email'=>'required|email:filter',
            'password'=>'required'
        ]);

        if(Auth::guard('member')->attempt([

            'email'=>$request->input('email'),
            'password'=>$request->input('password')

        ],$request->input('remember')))
        {
            return redirect() -> route('main');
        }
        Session::flash('error','Email hoặc Password không đúng');
        return redirect()->back();
    }
}
