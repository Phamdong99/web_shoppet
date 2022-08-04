@extends('admin.main')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tiêu đề</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập tên tiêu đề">
            </div>

            <div class="form-group">
                <label>Url</label>
                <input type="text" class="form-control" name="url" value="" placeholder="url">
            </div>

            <div class="form-group">
                <label for="menu">Ảnh</label>
                <input type="file" class="form-control"  id="upload" multiple >
                <div id="image_show">

                </div>
                <input type="hidden" name="file" id="file">
            </div>

            <div class="form-group">
                <label>Vị trí</label>
                <input type="number" class="form-control" name="sort_by" value="" placeholder="">
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
                <button type="submit" class="btn btn-primary">Tạo slider</button>
            </div>
        @csrf
    </form>
@endsection
