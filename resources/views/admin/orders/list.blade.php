@extends('admin.main')

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
{{--            <button type="button" class="btn btn-primary btn-lg">--}}
{{--                <a href="/admin/products/add" style="color: white">Thêm mới</a></button>--}}
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">ID</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng tiền đơn hàng</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Hình thức vận chuyển</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
               @foreach($orders as $key => $order)
                <tr>
                    <td>{{ $order->carts[0]->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->carts[0]->created_at  }}</td>
                    <td>{{ number_format($order->carts[0]->total,0). ' Vnd' }}</td>
                    <td>
                        <select name="active" class="active btn btn-secondary" id="active" data-cart="{{ $order->carts[0]->id }}" style="cursor:pointer;">
                            <option value="1" {{ $order->carts[0]->active == 1 ? 'selected' : ''}}>Chưa xác nhận</option>
                            <option value="2" {{ $order->carts[0]->active == 2 ? 'selected' : ''}}>Xác nhận chờ lấy hàng</option>
                            <option value="3" {{ $order->carts[0]->active == 3 ? 'selected' : ''}}>Đang giao</option>
                            <option value="4" {{ $order->carts[0]->active == 4 ? 'selected' : ''}}>Giao hàng thành công</option>
                            <option value="5" {{ $order->carts[0]->active == 5 ? 'selected' : ''}}>Đơn hàng đã huỷ</option>
                            <option value="6" {{ $order->carts[0]->active == 6 ? 'selected' : ''}}>Đơn hàng hoàn trả</option>
                        </select>
                    </td>
                    <td>{{ \App\Helper\Helper::active2($order->carts[0]->type) }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/orders/show/{{$order->carts[0]->id}}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
              @endforeach
                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection


