{{--<div class="wrap-header-cart js-panel-cart">--}}
{{--    <div class="s-full js-hide-cart"></div>--}}
{{--    <div class="header-cart flex-col-l p-l-65 p-r-25">--}}
{{--        <div class="header-cart-title flex-w flex-sb-m p-b-8">--}}
{{--				<span class="mtext-103 cl2">--}}
{{--					Giỏ Hàng--}}
{{--				</span>--}}

{{--            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">--}}
{{--                <i class="zmdi zmdi-close"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="header-cart-content flex-w js-pscroll">--}}
{{--            @php--}}
{{--            $total = 0;--}}
{{--            @endphp--}}
{{--            @if(!is_null($products_cart) && count($products_cart) > 0 && count($carts_qty) > 0 && ((Auth::guard('member')->user()->id)??''))--}}
{{--            @foreach($products_cart as $product)--}}
{{--                @foreach($carts[$product->id] as $product_cart)--}}
{{--                    @php--}}
{{--                    $total +=  $product_cart['qty']  * $product_cart['price']--}}
{{--                    @endphp--}}
{{--            <ul class="header-cart-wrapitem w-full">--}}
{{--                <li class="header-cart-item flex-w flex-t m-b-12">--}}
{{--                    <div class="header-cart-item-img">--}}
{{--                        <img src="{{$product->file}}" alt="IMG">--}}
{{--                    </div>--}}

{{--                    <div class="header-cart-item-txt p-t-8">--}}
{{--                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">--}}
{{--                            {{$product->name}}--}}
{{--                        </a>--}}

{{--                        <span class="header-cart-item-info">--}}
{{--								{{ $product_cart['qty'] }} x {{ $product_cart['price'] }}--}}
{{--							</span>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--                    @endforeach--}}
{{--            @endforeach--}}
{{--            @else--}}
{{--                <h4>Giỏ hàng đang trống</h4>--}}
{{--            @endif--}}

{{--            <div class="w-full">--}}
{{--                <div class="header-cart-total w-full p-tb-40">--}}
{{--                    Tổng giỏ hàng : {{ number_format($total). ' Vnd' }}--}}
{{--                </div>--}}

{{--                <div class="header-cart-buttons flex-w w-full">--}}
{{--                    <a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">--}}
{{--                        View Cart--}}
{{--                    </a>--}}

{{--                    <a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">--}}
{{--                        Check Out--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
