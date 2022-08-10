@extends('main.main')

@section('content')
{{--    @php--}}
{{--        $vnp_HashSecret = "LIXUQDQXRJUVVCGEOHJDZBHTSQFYXVUV";--}}
{{--                $vnp_SecureHash = $_GET['vnp_SecureHash'];--}}
{{--                $inputData = array();--}}
{{--                foreach ($_GET as $key => $value) {--}}
{{--                    if (substr($key, 0, 4) == "vnp_") {--}}
{{--                        $inputData[$key] = $value;--}}
{{--                    }--}}
{{--                }--}}

{{--                unset($inputData['vnp_SecureHash']);--}}
{{--                ksort($inputData);--}}
{{--                $i = 0;--}}
{{--                $hashData = "";--}}
{{--                foreach ($inputData as $key => $value) {--}}
{{--                    if ($i == 1) {--}}
{{--                        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);--}}
{{--                    } else {--}}
{{--                        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);--}}
{{--                        $i = 1;--}}
{{--                    }--}}
{{--                }--}}

{{--                $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);--}}

{{--    @endphp--}}
{{--    <div class="text-center p-t-150">--}}
{{--        <div class="container">--}}
{{--            <table class="table-responsive">--}}
{{--                <div class="form-group">--}}
{{--                    <label>Kết quả:</label>--}}
{{--                    <label>--}}
{{--                        <?php--}}
{{--                        if ($secureHash == $vnp_SecureHash) {--}}
{{--                            if ($_GET['vnp_ResponseCode'] == '00') {--}}
{{--                                echo "<span style='color:blue'>Thanh toán thành công. Cảm ơn quý khách đã sử dụng dịch vụ</span>";--}}
{{--                                Session::flush();--}}
{{--                            } else {--}}
{{--                                echo "<span style='color:red'>Thanh toán không thành công</span>";--}}
{{--                            }--}}
{{--                        } else {--}}
{{--                            echo "<span style='color:red'>Chu ky khong hop le</span>";--}}
{{--                        }--}}
{{--                        ?>--}}

{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label >Mã đơn hàng: <?php echo $_GET['vnp_TxnRef'] ?></label>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label >Số tiền đã thanh toán: <?php echo number_format($_GET['vnp_Amount']).' Vnd'?></label>--}}
{{--                </div>--}}
{{--                --}}{{-- <div class="form-group">--}}
{{--                     <label >Thời gian thanh toán:</label>--}}
{{--                     <label><?php echo $_GET['vnp_PayDate'] ?></label>--}}
{{--                 </div>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--        <br>--}}
{{--        <a class="btn btn-secondary" href="/">--}}
{{--            Quay Lại Trang Chủ--}}
{{--        </a>--}}
{{--        --}}{{-- <a class="btn btn-secondary" href="/history_cart">--}}
{{--             Đi tới lịch sử đặt hàng--}}
{{--         </a>--}}
{{--    </div>--}}
<div class="p-t-90">
    <h1>Thông báo đặt hàng thành công</h1>
</div>
@endsection
