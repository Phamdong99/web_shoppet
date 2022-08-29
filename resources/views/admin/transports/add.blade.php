@extends('admin.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label>Hình thức vận chuyển</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập HTVC">
            </div>
            <div class="form-group">
                <label for="menu">Giá</label>
                <input type="text" class="form-control" name="price" value="{{old('price')}}" placeholder="">
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tạo</button>
            </div>
        @csrf
    </form>
@endsection
