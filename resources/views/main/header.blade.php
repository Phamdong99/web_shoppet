{{--Danh mục--}}
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Chân trọng kính chào quý khách !
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="/member/information" class="flex-c-m trans-04 p-lr-25">
                        Tài khoản
                    </a>
                    @if((Auth::guard('member')->user()->id)??'')
                        <a href="/member/logout" class="flex-c-m trans-04 p-lr-25">
                            Đăng xuất
                        </a>
                    @else
                    <a href="/member/login" class="flex-c-m trans-04 p-lr-25">
                        Đăng nhập
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">

            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="/template/main/images/icons/logo-01.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu"><a href="/">Trang chủ</a></li>
                        <li>
                            {!! App\Helper\Helper::categories($categories) !!}
                        </li>

                        <li>
                            <a href="https://vnexpress.net/tag/thu-cung-738044">Tin tức</a>
                        </li>

                        <li>
                            <a href="/contacts">Liên hệ</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                    @if((Auth::guard('member')->user()->id)??'')
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                         data-notify="{{  !is_null(\Session::get('carts')) ? count(\Illuminate\Support\Facades\Session::get('carts')) : 0  }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    @else
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                             data-notify="0">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="/template/main/images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                 data-notify="{{  !is_null(\Session::get('carts')) ? count(\Illuminate\Support\Facades\Session::get('carts')) : 0  }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Chân trọng kính chào quý khách !
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Trợ giúp
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Tài khoản của tôi
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li class="active-menu"><a href="/">Trang chủ</a></li>
            <li>
                {!! App\Helper\Helper::categories($categories) !!}
            </li>

            <li>
                <a href="about.html">Thông tin</a>
            </li>

            <li>
                <a href="contact.html">Liên hệ</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/main/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" method="get" action="{{route('member.search')}}">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
