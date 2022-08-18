<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PaymentMethodService;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    protected $payment;

    public function __construct(PaymentMethodService $payment)
    {
        $this->payment = $payment;
    }

    public function index()
    {
        $payment = $this->payment->getPayment();
        return view('admin.payment_methods.list', [
            'title' => 'Phương thức thanh toán',
            'payments'=>$payment
        ]);
    }
    public function create()
    {
        return view('admin.payment_methods.add', [
            'title' => 'Thêm phương thức thanh toán'
        ]);
    }
    public function store(Request $request)
    {
       $this->payment->create($request);
        return redirect('admin/payment_methods/list');
    }


    public function destroy(Request $request)
    {
        $result = $this->payment->destroy($request);
        if($result)
        {
            return response()->json([
                'error'=>false,
                'message'=>'Thông báo xóa thành công'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
}
