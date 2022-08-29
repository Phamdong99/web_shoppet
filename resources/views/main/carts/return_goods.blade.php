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
                <form method="post">
                    <div class="carts">
                        <p>Vui lòng liên hệ shop để được hỗ trợ ! <a href="/contacts">Liên hệ</a></p>
                        <table class="table" id="table_pro_return">
                            <tbody>
                            <tr class="table_head">
                                <th>#</th>
                                <th class="column-1">Ảnh</th>
                                <th class="column-2">Tên sản phẩm</th>
                                <th class="column-3">Giá</th>
                                <th class="column-4">Số lượng</th>
                            </tr>
                            @foreach($carts as $key => $cart)
                                <tr>
                                    @php
                                        $qty = $cart->qty;
                                        $price = $cart->price;
                                    @endphp
                                    <td>
                                        <input type="checkbox" name="checkbox" value="{{ $cart->products->id }}">
                                        <input type="hidden" name="id_order" value="{{ $id_cart->id }}">
                                    </td>
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{ $cart->products->file }}" alt="IMG" style="width: 100px">
                                        </div>
                                    </td>
                                    <td class="column-2">{{ $cart->products->name }}</td>
                                    <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                    <td class="column-4">{{ $qty }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <div class="form-group">
                                <label>Lý do hoàn trả : </label>
                                <textarea type="text" class="form-control" id="content_return" name="content_return" style="height: 100px"></textarea>
                            </div>
                        </div>
                        <div class="p-l-300">
                            <button class="btn btn-danger" type="submit" id="btn_return_good">Trả hàng</button>
                            <a href="/history" class="btn btn-primary">Trở lại trang lịch sử</a>
                        </div>
                    </div>
                    @csrf
                </form>

            </div>
        </div>
    </div>
@endsection

