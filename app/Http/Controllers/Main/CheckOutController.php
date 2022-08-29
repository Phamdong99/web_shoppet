<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOut\CreateFormRequest;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Member;
use App\Models\PaymentMethod;
use App\Models\Transport;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Services\ProductService;

class CheckOutController extends Controller
{
    protected $checkoutService;
    protected $productService;

    public function __construct(CheckoutService $checkoutService, ProductService $productService)
    {
        $this->checkoutService = $checkoutService;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $arrProduct = $request->arrProduct;

        $new_array = array();

        foreach ($arrProduct as $key => $value) {
            if (is_null($value) === false) {
                $new_array[$key] = $value;
            }
        }
        Session::put('arrProduct', $new_array);
        return response()->json($arrProduct,200);

    }

    public function checkout()
    {
        $payment_method = $this->checkoutService->getPay();
        $discounts = $this->checkoutService->getDis();
        $transports = $this->checkoutService->getTran();
        $arrProduct =  Session::get('arrProduct');
        $idproduct = array_keys($arrProduct);
        $productCheck = [];
            if($idproduct){
                $productCheck = Product::whereIn('id', $idproduct)->get();
            }else{
                Session::flash('error','Bạn cần chọn sản phẩm trước khi thanh toán');
                return redirect('/carts');
            }
        return view('main.check_out', [
            'title' => 'Trang thanh toán',
            'products' => $productCheck,
            'carts'=> Session::get('carts'),
            'payment_methods'=> $payment_method,
            'discounts'=>$discounts,
            'transports'=>$transports,
            'arrproduct'=>$arrProduct
        ]);
    }

    public function discount_price(Request $request)
    {
        $id_discount = $request->input('id_discount');
        $discount = Discount::where('id', $id_discount)->first();

        Session::put('id_discount', $id_discount);
        $total = $request->input('total');
        if($total){
            $total -= $discount->discount;
        }

        return response()->json($total, 200);

    }
    public function transport_price(Request $request)
    {
        $type_cost = $request->input('cost');
        $transports = Transport::where('id', $type_cost)->first();

        Session::put('type_cost', $type_cost);

        $total = $request->input('total');
        if($total){
            $total += $transports->price;
        }


        return response()->json(['total'=>$total, 'transports'=>$transports], 200);

    }

    public function addCart(CreateFormRequest $request)
    {
        $pay_id = (int)$request->input('pay_id');
        $result = $this->checkoutService->addCart($request);
        if($result){
            if($pay_id == 2){
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
            return redirect()->route('history');

        }
        return redirect()->back();
    }

}
