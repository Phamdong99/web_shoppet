@extends('admin.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_cart_of_month }}</h3>

                            <p>Tổng số đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ number_format($total_of_month) }}</h3>

                            <p>Doanh số tháng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ count($members) }}</h3>

                            <p>Tổng số thành viên</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ count($product) }}</h3>

                            <p>Số sản phẩm đang bán</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row card">
                <h4 class="text-center">Đánh giá mới nhất</h4>
                <table class="table">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Tên người đánh giá</th>
                        <th>Email</th>
                        <th>Nội dung đánh giá</th>
                    </tr>
                    @foreach($reviews as $key => $review)
                        <tr>
                            <td>{{ $review->product->name }}</td>
                            <td>{{ $review->name }}</td>
                            <td>{{ $review->email }}</td>
                            <td>{{ $review->content }}</td>

                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="row card">
                <h4 class="text-center">Đơn hàng mới nhất</h4>
                <table class="table">
                    <tr>
                        <th>Đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Thời gian đặt hàng</th>
                        <th>Tổng tiền đơn hàng</th>
                        <th>Trạng thái</th>
                    </tr>
                    @foreach($orders as $key => $order)
                    <tr>
                        <td>{{ $order->carts[0]->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ number_format($order->carts[0]->total).' Vnd' }}</td>
                        <td>{{ \App\Helper\Helper::active1($order->carts[0]->active) }}</td>

                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
