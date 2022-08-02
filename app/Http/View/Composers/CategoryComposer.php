<?php

namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{

    protected $users;

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $categories = Category::where('active' ,1)->orderByDesc('id')->get();
        $view->with('categories', $categories);
    }
}
