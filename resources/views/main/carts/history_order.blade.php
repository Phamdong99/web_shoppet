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
    @include('admin.alert');
    <h1 class="text-center">Lịch Sử Đặt Hàng</h1>
    <br>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12 card">
            <br>
            <h5 class="text-center">Thông tin cá nhân</h5>
            <br>
            @foreach($members as $member)
            <ul class="p-l-80">
                <li>Tên : {{ $member->name }}</li>
                <li>Email : {{ $member->email }}</li>
                <li>Địa chỉ : {{ $member->address }}</li>
                <li>Số điện thoại : {{ $member->phone }}</li>
            </ul>
            @endforeach
        </div>
        <div class="col-md-9 col-sm-6 col-12 card">
            <br>
                <div class="flex-w flex-sb-m p-b-52">
                    <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".0">
                            Danh sách đơn đặt hàng
                        </button>

                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".1">
                            Chờ xác nhận
                        </button>

                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".2">
                            Chờ lấy hàng
                        </button>

                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".3">
                            Đang giao
                        </button>
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".4">
                            Giao thành công
                        </button>
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".5">
                            Đã hủy
                        </button>
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".6">
                            Trả hàng
                        </button>
                    </div>
                </div>
                <div class="row isotope-grid">
                    <div class="col-sm-6 col-md-4 col-lg-12 p-b-35 isotope-item 0">
                        <table class="table">
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach($orders as $order)
                                <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ number_format($order->total) }}</td>
                                        <td>{{ \App\Helper\Helper::active1($order->active) }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="/orders/show_detail/{{$order->id}}">
                                                Xem
                                            </a>
                                        </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-12 p-b-35 isotope-item 1">
                        <table class="table">
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->active == 1)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ number_format($order->total) }}</td>
                                <td style="color: #0c525d">Chờ xác nhận</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="/orders/show_detail/{{$order->id}}">
                                        Xem
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#"
                                       onclick="updateActive({{$order->id}}, 'history/update_active')">
                                        Hủy
                                    </a>
                                </td>
                            </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-12 p-b-35 isotope-item 2">
                        <table class="table">
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->active == 2)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ number_format($order->total) }}</td>
                                        <td style="color: #0c84ff">Chờ lấy hàng</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="/orders/show_detail/{{$order->id}}">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-12 p-b-35 isotope-item 3">
                        <table class="table">
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->active == 3)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ number_format($order->total) }}</td>
                                        <td style="color: #0c5460">Đang giao</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="/orders/show_detail/{{$order->id}}">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-12 p-b-35 isotope-item 4">
                        <table class="table">
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->active == 4)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ number_format($order->total) }}</td>
                                        <td style="color: green">Đơn hàng thành công</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="/orders/show_detail/{{$order->id}}">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-12 p-b-35 isotope-item 5">
                        <table class="table">
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->active == 5)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ number_format($order->total)}}</td>
                                        <td style="color: red">Đơn hàng đã hủy</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="/orders/show_detail/{{$order->id}}">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-12 p-b-35 isotope-item 6">
                        <table class="table">
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach($orders as $order)
                                @if($order->active == 6)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ number_format($order->total) }}</td>
                                        <td style="color: darkred">Đơn hàng hoàn trả</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="/orders/show_detail/{{$order->id}}">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

