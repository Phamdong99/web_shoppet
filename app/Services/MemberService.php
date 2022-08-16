<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MemberService
{
    public function create_register($request)
    {
        try{
            Member::create([
                'name' => (string) $request->input('name'),
                'email' => (string) $request->input('email'),
                'password' => Hash::make((string) $request->input('password')),
                'address' => (string) $request->input('address'),
                'phone' => (string) $request->input('phone')

            ]);
            Session::flash('success','Thêm thành viên mới thành công');

        }catch (\Exception $err){
            Session::flash('error','Thêm thành viên lỗi');
            log::info($err->getMessage());

            return false;
        }

        return true;
    }
    public function getMembers()
    {
        return Member::latest()->get();
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $member = Member::find($id);
        if($member){
            return Member::where('id', $id)->delete();
        }
    }
}
