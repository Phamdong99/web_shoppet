<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\ContactService;
use http\Client\Response;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        return view('admin.contact.list', [
            'title'=>'Thông tin liên hệ',
            'contacts'=>$this->contactService->getAll()
        ]);
    }

    public function create()
    {
        return view('admin.contact.add', [
            'title'=>'Thêm thông tin liên hệ'
        ]);
    }

    public function store(Request $request)
    {
        $this->contactService->create($request);
        return redirect('admin/contacts/list');
    }

    public function show(Contact $contact)
    {
        return view('admin.contact.edit', [
            'title'=>'Sửa thông tin liên hệ',
            'contact'=>$contact
        ]);
    }

    public function update(Request $request,Contact $contact)
    {
        $this->contactService->update($request,$contact);
        return redirect('admin/contacts/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->contactService->destroy($request);

        if($result){
            return \response()->json([
                'error'=>false,
                'message'=>'Xoá danh mục thành công'
            ]);
        }
        return \response()->json([
            'error'=>true
        ]);

    }

    public function show_contact()
    {
        return view('main.contact', [
            'title'=>'Thông tin liên hệ',
            'contacts'=>$this->contactService->getContact()
        ]);
    }

}
