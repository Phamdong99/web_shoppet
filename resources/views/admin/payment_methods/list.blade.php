@extends('admin.main')

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-lg">
                <a href="/admin/payment_methods/add" style="color: white">Thêm mới</a></button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">ID</th>
                    <th>Phương thức</th>
                    <th width="100px">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $key => $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{$payment->name}}</td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="#"
                               onclick="removeRow({{$payment->id}}, '/admin/payment_methods/destroy')">
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
