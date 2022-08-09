@extends('main.main')

@section('content')
    <form class="bg0 p-t-130 p-b-85" method="post">
        @include('admin.alert')
        @if (count($products) != 0)
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                @php $total = 0; @endphp
                                <table class="table table-bordered table-striped" id="table_product">
                                    <tr class="table_head">
                                        <th class="column-2">Ảnh</th>
                                        <th class="column-3">Tên</th>
                                        <th class="column-4">Giá</th>
                                        <th class="column-5">Số Lượng</th>
                                        <th class="column-6">Tổng tiền</th>
                                    </tr>
                                    @foreach($products as $key => $product)
                                        @php
                                            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                            $priceEnd = $price * $carts[$product->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <input type="hidden" name="product_id[]" value="{{$product->id}}">
                                        <tbody>
                                        <tr class="table_row">
                                            <td class="column-2">
                                                <div class="how-itemcart1">
                                                    <img src="{{ $product->file }}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-3">{{ $product->name }}</td>
                                            <td class="column-4">{{ number_format($price, 0, '', '.') }} VND</td>
                                            <td class="column-5">
                                                {{ $carts[$product->id] }}
                                            </td>
                                            <td class="column-6">{{ number_format($priceEnd, 0, '', '.') }} VND</td>
                                        </tr>
                                        </tbody>
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
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
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
                                    <span class="mtext-110 cl2">
                                        {{ number_format($total, 0, '', '.') }} VND
                                    </span>
                                </div>
                            </div>
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
        </div>
    @endif
@endsection

