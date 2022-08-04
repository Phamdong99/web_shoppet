<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ReviewService
{
    //Khách hàng
    public function create_review($request)
    {
        try {
            Review::create([
                'pro_id' => (int)$request->input('product_id'),
                'name' => (string)$request->input('name'),
                'email' => (string)$request->input('email'),
                'content' => (string)$request->input('content'),
                'active'=>(int)$request->input('1')
            ]);

            Session::flash('success', 'Đánh giá thành công');

        } catch (\Exception $err) {

            Session::flash('error', 'Đánh giá không thành công');
            return false;
        }
        return true;

    }
}
