@extends('admin.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label>Mã giảm giá</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập MGG mới">
            </div>
            <div class="form-group">
                <label for="menu">Giảm</label>
                <input type="text" class="form-control" name="discount" value="{{old('discount')}}" placeholder="%">
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tạo</button>
            </div>
        @csrf
    </form>
@endsection
