@extends('admin.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Phương thức thanh toán</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập PTTT mới">
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tạo PTTT</button>
            </div>
        @csrf
    </form>
@endsection
