@extends('admin.main')

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-lg">
                <a href="/admin/discounts/add" style="color: white">Thêm mới</a></button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">ID</th>
                    <th>Tên mã</th>
                    <th>Giảm</th>
                    <th width="100px">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($discounts as $key => $discount)
                    <tr>
                        <td>{{ $discount->id }}</td>
                        <td>{{$discount->name}}</td>
                        <td>{{$discount->discount}}</td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="#"
                               onclick="removeRow({{$discount->id}}, '/admin/discounts/destroy')">
                                <i class="fas fa-trash-alt"></i>
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
