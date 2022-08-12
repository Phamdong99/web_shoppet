<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOut\CreateFormRequest;
use App\Models\PaymentMethod;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CheckOutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function index(Request $request)
    {
       $id_product = $request['id_product'];

        Session::put('id_product', $id_product);
        return response()->json($id_product,200);

    }

    public function checkout()
    {
        $payment_method = $this->checkoutService->getPay();
        $id_product = Session::get('id_product');
        $productCheck = Product::whereIn('id', [$id_product])->get();
        $carts = Session::get('carts');

        return view('main.check_out', [
            'title' => 'Trang thanh toán',
            'products' => $productCheck,
            'carts'=> $carts,
            'payment_methods'=> $payment_method
        ]);

    }

    public function addCart(CreateFormRequest $request)
    {
        $pay_id = (int)$request->input('pay_id');

        $result = $this->checkoutService->addCart($request);
        if($result){
            if($pay_id == 1){
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://127.0.0.1:8000/history";
                $vnp_TmnCode = "L8JU9RJK";//Mã website tại VNPAY
                $vnp_HashSecret = "LIXUQDQXRJUVVCGEOHJDZBHTSQFYXVUV"; //Chuỗi bí mật

                $vnp_TxnRef = $result->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
                $vnp_OrderInfo = 'Thanh toán đơn hàng';
                $vnp_OrderType = 'billpayment';//loại thanh toán
                $vnp_Amount = $result->total * 100;
                $vnp_Locale = 'VN';
                $vnp_BankCode = 'NCB';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
//                $vnp_ExpireDate = $_POST['txtexpire'];
//Billing

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef
                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                }

//var_dump($inputData);
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
                // vui lòng tham khảo thêm tại code demo
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function history_order()
    {
       return view('main.carts.history_order', [
           'title'=>'Lịch sử đơn hàng'
       ]);
    }

}
