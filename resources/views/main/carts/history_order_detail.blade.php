@extends('main.main')

@section('content')
    <div class="p-t-90">
        @include('admin.alert');
        <h1 class="text-center">{{ $title }}</h1>
        <br>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 card">
                <br>
                <h5 class="text-center">Thông tin người nhận</h5>
                <br>
                    <ul class="p-l-80">
                        <li>Tên : {{ $customer->name }}</li>
                        <li>Email : {{ $customer->email }}</li>
                        <li>Địa chỉ : {{ $customer->address }}</li>
                        <li>Số điện thoại : {{ $customer->phone }}</li>
                    </ul>
            </div>
            <div class="col-md-9 col-sm-6 col-12 card">
                <br>
                <div class="carts">
                    <table class="table">
                        <tbody>
                        <tr class="table_head">
                            <th class="column-1">Ảnh</th>
                            <th class="column-2">Tên sản phẩm</th>
                            <th class="column-3">Giá</th>
                            <th class="column-4">Số lượng</th>
                            <th class="column-5">Tổng tiền</th>
                        </tr>
                        @foreach($carts as $key => $cart)
                            <tr>
                                @php
                                    $qty = $cart->qty;
                                    $price = $cart->price;
                                    $price_total =  $qty * $price
                                @endphp
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ $cart->products->file }}" alt="IMG" style="width: 100px">
                                    </div>
                                </td>
                                <td class="column-2">{{ $cart->products->name }}</td>
                                <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                <td class="column-4">{{ $qty }}</td>
                                <td class="column-5">{{ number_format($price_total, 0, '', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">Tổng Tiền : </td>
                            <td>{{ number_format($total, 0, '', '.')  }} VND</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Thanh toán : </td>
                            <td>{{ $payment_method }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="p-l-300">
                        <a href="/history" class="btn btn-primary">Trở lại trang lịch sử</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

