@extends('admin.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Cơ sở</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="">
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="">
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="">
            </div>

            <div class="form-group">
                <label>Facebook</label>
                <input type="text" class="form-control" name="facebook" value="{{old('facebook')}}" placeholder="">
            </div>

            <!-- /.card-body -->
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tạo mới</button>
            </div>
        @csrf
    </form>
@endsection
