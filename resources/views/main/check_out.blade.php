@extends('main.main')


@section('content')
    <form class="bg0 p-t-130 p-b-85" method="post">
        @include('admin.alert')
        @if (count($products) != 0)
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <h2 class="p-l-230">{{ $title }}</h2>
                            <br>
                            <div class="wrap-table-shopping-cart">
                                @php $total = 0; @endphp
                                <table class="table table-bordered table-striped" id="table_product">
                                    <tr class="table_head">
                                        <th class="column-2">Ảnh</th>
                                        <th class="column-3">Tên</th>
                                        <th>Size</th>
                                        <th class="column-4">Giá</th>
                                        <th class="column-5">Số Lượng</th>
                                        <th class="column-6">Tổng tiền</th>
                                    </tr>
                                    @foreach($products as $key => $product)
                                        @foreach($carts[$product->id] as $size_id => $product_cart)
                                            @foreach($arrproduct[$product->id] as $k => $arrsize)
                                                @if($size_id == $arrsize)
                                            @php
                                            $priceEnd = $product_cart['price'] * $product_cart['qty'];
                                            $total += $priceEnd;
                                            @endphp
                                        <input type="hidden" name="cart_item[{{$product->id}}]" value="{{ $product_cart['qty'] }}" data-size-id="{{ $arrsize }}">
                                        <input type="hidden" name="member_id" value="{{  Auth::guard('member')->user()->id }}">
                                        <tbody>
                                        <tr class="table_row">
                                            <td class="column-2">
                                                <div class="how-itemcart1">
                                                    <img src="{{ $product->file }}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-3">{{ $product->name }}</td>
                                            <td>{{ $product_cart['label'] }}</td>
                                            <td class="column-4">{{ $product_cart['price'] }}</td>
                                            <td class="column-5">
                                                {{ $product_cart['qty'] }}
                                            </td>
                                            <td class="column-6">{{ $priceEnd }} </td>
                                        </tr>
                                        </tbody>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    {{-- <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                            name="coupon" placeholder="Coupon Code">
 --}}
                                    <a href="/carts"
                                       class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" >
                                        Quay lại giỏ hàng
                                    </a>
                                </div>
                                <div class="flex-w flex-t">
                                    <div class="size-208">
                                            <span class="mtext-101 cl2 pull-right">
                                                 Tổng:
                                            </span>
                                    </div>

                                    <div class="size-209 pull-right">
                                            <span class="mtext-110 cl2 " >
                                                 {{ number_format($total, 0, '', '.') }} VND
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <h4>Hình thức vận chuyển</h4>
                                <br>
                                @foreach($transports as $key => $transport)
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input value="{{ $transport->id }}" type="radio" id="type" name="type" >
                                        <label for="type" class="custom-control-label">{{ $transport->name }}</label>
                                        <label for="type" class="custom-control-label p-l-115">{{ number_format($transport->price). ' Vnd' }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="card p-t-10">
                                <h4>Mã giảm giá</h4>
                                <br>
                                <select class="form-select" id="discount_id">
                                    <option selected>--Bạn có thể chọn mã giảm giá cho đơn hàng--</option>
                                    @foreach($discounts as $key => $discount)
                                    <option value="{{ $discount->id }}">{{ $discount->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <div class="flex-w flex-t p-t-27 p-b-20">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">Phí VC:</span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2" id="price_transport">
                                        0
                                    </span>
                                </div>
                            </div>
                            <div class="flex-w flex-t p-t-5 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Giảm giá:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2" id="discount">
                                        0
                                    </span>
                                </div>
                            </div>

                            <h4 class="mtext-109 cl2 p-b-30">
                                Tổng đơn hàng
                            </h4>
                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Tổng:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2"  id="total_order">
                                        {{ number_format($total, 0, '', '.') }} VND
                                        <input type="hidden" class="total" id="total" value="{{$total}}">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">

                                <div class="size-100 p-r-18 p-r-0-sm w-full-ssm">

                                    <div class="p-t-15">
                                                                    <span class="stext-112 cl8">
                                                                        <h5>Thông Tin Khách Hàng</h5>
                                                                    </span>
                                        <br>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" value="{{old('name')}}" placeholder="Tên khách Hàng">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" value="{{old('phone')}}" placeholder="Số Điện Thoại">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" value="{{old('address')}}" placeholder="Địa Chỉ Giao Hàng">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" value="{{old('email')}}" placeholder="Email Liên Hệ">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <textarea class="cl8 plh3 size-111 p-lr-15" name="content" placeholder="Nội dung">{{old('content')}}</textarea>
                                        </div>

                                        <select class="btn btn-secondary" name="pay_id" style="cursor:pointer;">
                                            @foreach($payment_methods as $payment_method)
                                                <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" name="redirect" >
                                Tiếp Tục Thanh Toán
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
    </form>
    @else
        <div class="text-center">
            <h2>Giỏ hàng trống</h2>
            <br>
            <a class="btn btn-secondary" href="/">
                Quay Lại Trang Chủ
            </a>
            <a class="btn btn-secondary" href="/history">
                Đi đến lịch sử đặt hàng
            </a>
        </div>
    @endif
@endsection

