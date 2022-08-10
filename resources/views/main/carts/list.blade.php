@extends('main.main')

@section('content')
    <form class="bg0 p-t-130 p-b-85" method="post" action="/check-out">
        @include('admin.alert')
        @if (count($products) != 0)
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <h2 class="p-l-250">{{ $title }}</h2>
                            <br>
                            <div class="wrap-table-shopping-cart">
                                @php $total = 0; @endphp
                                <table class="table table-bordered table-striped" id="table_product">
                                    <tr class="table_head">
                                        <th class="column-1">
                                            <div class="checkbox">
                                                <label><input id="check_all" type="checkbox" value=""></label>
                                            </div>
                                        </th>
                                        <th class="column-2">Ảnh</th>
                                        <th class="column-3">Tên</th>
                                        <th class="column-4">Giá</th>
                                        <th class="column-5">Số Lượng</th>
                                        <th class="column-6">Tổng tiền</th>
                                        <th class="column-7">Xóa</th>
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
                                            <td class="column-1">
                                                <div class="checkbox" id="">
                                                    <label><input type="checkbox" value="{{$product->id}}"></label>
                                                </div>
                                            </td>
                                            <td class="column-2">
                                                <div class="how-itemcart1">
                                                    <img src="{{ $product->file }}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-3">{{ $product->name }}</td>
                                            <td class="column-4">{{ number_format($price, 0, '', '.') }} VND</td>
                                            <td class="column-5">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                           name="num_product[{{ $product->id }}]"
                                                           value="{{ $carts[$product->id] }}"
                                                           data-product-max="{{$product->qty}}">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-6">{{ number_format($priceEnd, 0, '', '.') }} VND</td>
                                            <td class="column-7">
                                                <a href="/carts/delete/{{ $product->id }}">
                                                    Xoá
                                                </a>
                                            </td>
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
                                    <a href="/"
                                       class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" >
                                        Tiếp tục mua hàng
                                    </a>
                                </div>

                                <input type="submit" value="Cập nhật giỏ hàng" formaction="/update-cart"
                                       class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                @csrf
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Tổng giỏ hàng
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
                            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" id="check_out">
                                Thanh Toán
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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

