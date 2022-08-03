@extends('admin.main')
@section('content')
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Cơ sở</label>
                <input type="text" class="form-control" name="name" value="{{ $contact->name }}" placeholder="">
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="{{ $contact->address }}" placeholder="">
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}" placeholder="">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="{{ $contact->email }}" placeholder="">
            </div>

            <div class="form-group">
                <label>Facebook</label>
                <input type="text" class="form-control" name="facebook" value="{{$contact->facebook}}" placeholder="">
            </div>

            <!-- /.card-body -->
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active"
                           name="active" {{$contact->active == 1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active"
                           name="active" {{$contact->active == 0 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">No</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sửa</button>
            </div>
        @csrf
    </form>
@endsection

