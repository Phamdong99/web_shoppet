@extends('main.main')

@section('content')
   <div class="p-t-90">
       <!-- Cart -->
       <div class="wrap-header-cart js-panel-cart">
           <div class="s-full js-hide-cart"></div>

           <div class="header-cart flex-col-l p-l-65 p-r-25">
               <div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

                   <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                       <i class="zmdi zmdi-close"></i>
                   </div>
               </div>

               <div class="header-cart-content flex-w js-pscroll">
                   <ul class="header-cart-wrapitem w-full">
                       <li class="header-cart-item flex-w flex-t m-b-12">
                           <div class="header-cart-item-img">
                               <img src="images/item-cart-01.jpg" alt="IMG">
                           </div>

                           <div class="header-cart-item-txt p-t-8">
                               <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                   White Shirt Pleat
                               </a>

                               <span class="header-cart-item-info">
								1 x $19.00
							</span>
                           </div>
                       </li>

                       <li class="header-cart-item flex-w flex-t m-b-12">
                           <div class="header-cart-item-img">
                               <img src="images/item-cart-02.jpg" alt="IMG">
                           </div>

                           <div class="header-cart-item-txt p-t-8">
                               <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                   Converse All Star
                               </a>

                               <span class="header-cart-item-info">
								1 x $39.00
							</span>
                           </div>
                       </li>

                       <li class="header-cart-item flex-w flex-t m-b-12">
                           <div class="header-cart-item-img">
                               <img src="images/item-cart-03.jpg" alt="IMG">
                           </div>

                           <div class="header-cart-item-txt p-t-8">
                               <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                   Nixon Porter Leather
                               </a>

                               <span class="header-cart-item-info">
								1 x $17.00
							</span>
                           </div>
                       </li>
                   </ul>

                   <div class="w-full">
                       <div class="header-cart-total w-full p-tb-40">
                           Total: $75.00
                       </div>

                       <div class="header-cart-buttons flex-w w-full">
                           <a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                               View Cart
                           </a>

                           <a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                               Check Out
                           </a>
                       </div>
                   </div>
               </div>
           </div>
       </div>


       <!-- breadcrumb -->
       <div class="container">
           <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
               <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                   Home
                   <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
               </a>

               <a href="/san-pham/{{$product->menu->id}}-{{\Illuminate\Support\Str::slug($product->menu->name,'-')}}.html" class="stext-109 cl8 hov-cl1 trans-04">
                   {{$product->menu->name}}
                   <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
               </a>

               <span class="stext-109 cl4">
				{{$title}}
			</span>
           </div>
       </div>


       <!-- Product Detail -->
       <section class="sec-product-detail bg0 p-t-65 p-b-60">
           <div class="container">
               <div class="row">
                   <div class="col-md-6 col-lg-7 p-b-30">
                       <div class="p-l-25 p-r-30 p-lr-0-lg">
                           <div class="wrap-slick3 flex-sb flex-w">
                               <div class="wrap-slick3-dots"></div>
                               <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                               <div class="slick3 gallery-lb">
                                   <div class="item-slick3" data-thumb="{{ $product->file }}">
                                       <div class="wrap-pic-w pos-relative">
                                           <img src="{{ $product->file }}" alt="IMG-PRODUCT">

                                           <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
                                               <i class="fa fa-expand"></i>
                                           </a>
                                       </div>
                                   </div>

                                   <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                                       <div class="wrap-pic-w pos-relative">
                                           <img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                           <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
                                               <i class="fa fa-expand"></i>
                                           </a>
                                       </div>
                                   </div>

                                   <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                                       <div class="wrap-pic-w pos-relative">
                                           <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                           <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
                                               <i class="fa fa-expand"></i>
                                           </a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="col-md-6 col-lg-5 p-b-30">
                       <div class="p-r-50 p-t-5 p-lr-0-lg">
                           <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                               {{$title}}
                           </h4>

                           <span class="mtext-106 cl2">
							 {!!  \App\Helper\Helper::price($product->price, $product->price_sale) !!}
						</span>

                           <p class="stext-102 cl3 p-t-23">
                               {{ $product->content }}
                           </p>

                           <!--  -->
                               @if($product->price != 0)
                                   <div class="p-t-33">
                                       <form method="post" action="/add-cart">
                                           <input type="hidden" name="pro_id" id="pro_id" value="{{$product->id}}">
                                           <div class="flex-w flex-r-m p-b-10">
                                               <div class="size-203 flex-c-m respon6">
                                                   Size
                                               </div>

                                               <div class="size-204 respon6-next">
                                                   <div class="rs1-select2 bor8 bg0">
                                                       <select class="js-select2" name="time">
                                                           <option>Chọn size</option>
                                                           <option>Size S</option>
                                                           <option>Size M</option>
                                                           <option>Size L</option>
                                                           <option>Size XL</option>
                                                       </select>
                                                       <div class="dropDownSelect2"></div>
                                                   </div>
                                               </div>
                                           </div>

                                           <div class="flex-w flex-r-m p-b-10">
                                               <div class="size-204 flex-w flex-m respon6-next">
                                                   <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                       <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                           <i class="fs-16 zmdi zmdi-minus"></i>
                                                       </div>

                                                       <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                              id="num-product"
                                                              name="num_product" value="1"
                                                              data-product-max="{{$product->qty}}">

                                                       <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                           <i class="fs-16 zmdi zmdi-plus"></i>
                                                       </div>
                                                   </div>

                                                   <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                       Thêm vào giỏ hàng
                                                   </button>
                                               </div>
                                           </div>
                                           @csrf
                                       </form>
                                   </div>
                               @endif

                           <!--  -->
                           <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                               <div class="flex-m bor9 p-r-10 m-r-11">
                                   <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                       <i class="zmdi zmdi-favorite"></i>
                                   </a>
                               </div>

                               <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                                   <i class="fa fa-facebook"></i>
                               </a>

                               <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                                   <i class="fa fa-twitter"></i>
                               </a>

                               <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                                   <i class="fa fa-google-plus"></i>
                               </a>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="bor10 m-t-50 p-t-43 p-b-40">
                   <!-- Tab01 -->
                   <div class="tab01">
                       <!-- Nav tabs -->
                       <ul class="nav nav-tabs" role="tablist">
                           <li class="nav-item p-b-10">
                               <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                           </li>

                           <li class="nav-item p-b-10">
                               <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
                           </li>
                           @php
                           $count_review = 0;
                           @endphp
                            @foreach($reviews as $review)
                                @php
                               $count_review = $count_review + 1
                               @endphp
                           @endforeach
                           <li class="nav-item p-b-10">
                               <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews ({{ $count_review }})</a>
                           </li>
                       </ul>

                       <!-- Tab panes -->
                       <div class="tab-content p-t-43">
                           <!-- - -->
                           <div class="tab-pane fade show active" id="description" role="tabpanel">
                               <div class="how-pos2 p-lr-15-md">
                                   <p class="stext-102 cl6">
                                    {{$product->description}}
                                   </p>
                               </div>
                           </div>

                           <!-- - -->
                           <div class="tab-pane fade" id="information" role="tabpanel">
                               <div class="row">
                                   <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                       <ul class="p-lr-28 p-lr-15-sm">
                                           <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Weight
											</span>

                                               <span class="stext-102 cl6 size-206">
												0.79 kg
											</span>
                                           </li>

                                           <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Dimensions
											</span>

                                               <span class="stext-102 cl6 size-206">
												110 x 33 x 100 cm
											</span>
                                           </li>

                                           <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Materials
											</span>

                                               <span class="stext-102 cl6 size-206">
												60% cotton
											</span>
                                           </li>

                                           <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Color
											</span>

                                               <span class="stext-102 cl6 size-206">
												Black, Blue, Grey, Green, Red, White
											</span>
                                           </li>

                                           <li class="flex-w flex-t p-b-7">
											<span class="stext-102 cl3 size-205">
												Size
											</span>

                                               <span class="stext-102 cl6 size-206">
												XL, L, M, S
											</span>
                                           </li>
                                       </ul>
                                   </div>
                               </div>
                           </div>

                           <!-- - -->
                           <!-- Đánh giá sản phẩm -->

                           <div class="tab-pane fade" id="reviews" role="tabpanel">
                               <div class="row">
                                   <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                       <div class="p-b-30 m-lr-15-sm">
                                           <!-- Review -->
                                           @foreach($reviews as $review)
                                               @if($review->active != 1)
                                                   <div class="flex-w flex-t p-b-68">
                                                       <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                           <img src="{{asset('/template/main/images/user.jpg')}}" alt="AVATAR">
                                                       </div>

                                                       <div class="size-207">
                                                           <div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														{{ $review->name }}
													</span>

                                                               <span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span>
                                                           </div>

                                                           <p class="stext-102 cl6">
                                                               {{ $review->content }}
                                                           </p>
                                                       </div>
                                                   </div>
                                               @endif
                                           @endforeach
                                           <!-- Add review -->
                                           <form class="w-full" method="post">
                                               <input type="hidden" name="product_id" value="{{$product->id}}">
                                               @include('admin.alert')
                                               <h5 class="mtext-108 cl2 p-b-7">
                                                   Đánh giá
                                               </h5>

                                               <div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Đánh Giá
												</span>

                                                   <span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
                                               </div>

                                               <div class="row p-b-25">
                                                   <div class="col-12 p-b-5">
                                                       <label class="stext-102 cl3" for="review">Nội dung đánh giá</label>
                                                       <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                                 id="review" name="content"></textarea>
                                                   </div>

                                                   <div class="col-sm-6 p-b-5">
                                                       <label class="stext-102 cl3" for="name">Tên người đánh giá</label>
                                                       <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text"
                                                              name="name">
                                                   </div>

                                                   <div class="col-sm-6 p-b-5">
                                                       <label class="stext-102 cl3" for="email">Email</label>
                                                       <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                              type="text" name="email">
                                                   </div>
                                               </div>

                                               <button
                                                   class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                   Đánh giá
                                               </button>
                                               @csrf
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				{{$title}}
			</span>

               <span class="stext-107 cl6 p-lr-25">
				Danh mục : {{$product->menu->name}}
			</span>
           </div>
       </section>


       <!-- Related Products -->
       <section class="sec-relate-product bg0 p-t-45 p-b-105">
           <div class="container">
               <div class="p-b-45">
                   <h3 class="ltext-106 cl5 txt-center">
                       Sản phẩm liên quan
                   </h3>
               </div>

               <!-- Slide2 -->
               @include('main.product')
           </div>
       </section>

   </div>
@endsection
