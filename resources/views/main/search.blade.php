@extends('main.main')

@section('content')
    <div class="p-t-120">
        <section class="bg0 p-t-23 p-b-140">
            <div class="container">
                <div class="p-b-10">
                    <h3 class="ltext-103 cl5">
                        Danh sách sản phẩm
                    </h3>
                </div>
                <div id="loadProduct">
                    @include('main.product')

                </div>
            </div>
        </section>
    </div>
@endsection
