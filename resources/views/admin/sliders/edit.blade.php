@extends('admin.main')
@section('content')
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tiêu đề</label>
                <input type="text" class="form-control" name="name" value="{{ $slider->name }}" placeholder="">
            </div>


            <div class="form-group">
                <label for="menu">url</label>
                <input type="text" class="form-control" name="url" value="{{$slider->url}}" placeholder="">
            </div>

            <div class="form-group">
                <label for="menu">Vị trí</label>
                <input type="number" class="form-control" name="sort_by" value="{{$slider->sort_by}}" placeholder="">
            </div>

            <div class="form-group">
                <label for="menu">Ảnh</label>
                <input type="file" class="form-control"  id="upload" value="{{ $slider->file }}">
                <div id="image_show">
                    <a href="{{$slider->file}}" target="_blank">
                        <img src="{{$slider->file}}" width="100px">
                    </a>
                </div>
                <div id="image_show">

                </div>
                <input type="hidden" name="file" id="file" value="{{$slider->file}}">
            </div>

            <!-- /.card-body -->
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active"
                           name="active" {{$slider->active == 1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active"
                           name="active" {{$slider->active == 0 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">No</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sửa slider</button>
            </div>
        @csrf
    </form>
@endsection

