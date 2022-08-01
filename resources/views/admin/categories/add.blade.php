@extends('admin.main')

@section('head')
    <script src="/template/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Danh mục">
            </div>
            <div class="form-group">
                <label>Danh mục cha</label>
                <select class="form-control" name="parent_id" id="parent_id">
                    <option value="0">Danh mục cha</option>
                    @foreach($categories as $key => $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh</label>
                <input type="file" class="form-control"  id="upload" multiple >
                <div id="image_show">

                </div>
                <input type="hidden" name="file" id="file">
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea type="text" class="form-control" id="description" name="description" placeholder="Mô tả">
                </textarea>
            </div>
            <div class="form-group">
                <label>Nội dung</label>
                <textarea type="text" class="form-control" id="content" name="content" placeholder="Nội dung">
                                    </textarea>
            </div>
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
                <button type="submit" class="btn btn-primary">Tạo danh mục</button>
            </div>
        </div>
        @csrf
    </form>
@endsection
@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'content' );
    </script>
@endsection
