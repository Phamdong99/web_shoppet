@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên danh mục</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}" placeholder="Nhập tên danh mục">
            </div>
            <div class="form-group">
                <label for="menu">Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0" {{$category->parent_id == 0 ? 'selected' : ''}}>Danh mục cha</option>
                    @foreach($categories as $categoryParent)
                        <option value="{{ $categoryParent->id }}" {{$category->parent_id == $categoryParent->id ? 'selected' : ''}}>
                            {{ $categoryParent->name }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <label for="menu">Ảnh</label>
                <input type="file" class="form-control"  id="upload" value="{{ $category->file }}">
                <div id="image_show">
                    <a href="{{$category->file}}">
                        <img src="{{$category->file}}" width="100px">
                    </a>
                </div>
                <div id="image_show">

                </div>
                <input type="hidden" name="file" id="file">
            </div>

            <div class="form-group">
                <label for="menu">Mô tả</label>
                <textarea name="description" class=form-control>{{$category->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Mô tả chi tiết</label>
                <textarea name="content" id="content" class=form-control>{{$category->content}}</textarea>
            </div>

            <!-- /.card-body -->
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active"
                           name="active" {{$category->active == 1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active"
                           name="active" {{$category->active == 0 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sửa danh mục</button>
            </div>
        @csrf
    </form>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
