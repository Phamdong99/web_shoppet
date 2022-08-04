@extends('admin.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Size</label>
                <input type="text" class="form-control" name="size" value="{{old('size')}}" placeholder="Nhập size mới">
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tạo size</button>
            </div>
        @csrf
    </form>
@endsection
