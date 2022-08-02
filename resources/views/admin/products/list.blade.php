@extends('admin.main')

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-lg">
                <a href="/admin/products/add" style="color: white">Thêm mới</a></button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Giá giảm giá</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ $product->file }}" alt="" width="60px"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price)}} </td>
                    <td>{{ number_format($product->price_sale)}} </td>
                    <td>{{ $product->qty }}</td>
                    <td>{!! App\Helper\Helper::active($product->active) !!}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{$product->id}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                           onclick="removeRow({{$product->id}}, '/admin/products/destroy')">
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
