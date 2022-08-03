<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class ContactService
{
    public function getAll()
    {
        return Contact::where('active',1)->get();
    }
    public function create($request)
    {
        try{
            Contact::create($request->all());
            Session::flash('success','Thông báo thêm mới thành công');
        }catch (\Exception $err)
        {
            Session::flash('error',$err->getMessage());
        }

    }

    public function update($request,$contact)
    {
        try {
            $contact->fill($request->input());
            $contact->save();
            Session::flash('success','Thông báo sửa thành công');

        }catch (\Exception $err)
        {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function destroy($request)
    {
       $id = (int)$request->input('id');

       $contact = Contact::find($id);
       if($contact)
       {
           return Contact::where('id',$id)->delete();
       }
       return false;

    }


}
