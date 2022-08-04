<?php

namespace App\Http\View\Composers;

use App\Models\Contact;
use Illuminate\View\View;

class ContactComposer
{
    protected $users;

    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $contacts = Contact::where('active' ,1)->get();
        $view->with('contacts', $contacts);
    }
}
