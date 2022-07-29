@extends('admin.main')

@section('head')
    <script src="/template/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa danh mục</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control" value="{{ $category->name }}" id="name" name="name" placeholder="Danh mục">
                                </div>
                                <div class="form-group">
                                    <label>Danh mục cha</label>
                                    <select class="form-control" name="parent_id" id="parent_id">
                                        <option value="0" {{$category->Parent_id == 0 ? 'selected' : ''}}>Danh mục cha</option>
                                        @foreach($categories as $categoryParent)
                                            <option value="{{$categoryParent->id}}"
                                                {{$category->Parent_id == $categoryParent->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Mô tả">{{ $category->description }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea type="text" class="form-control" id="content" name="content" placeholder="Nội dung">{{ $category->content }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Kích Hoạt</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked=""
                                            {{ $category->active == 1 ? 'checked' : ''}}>
                                        <label for="active" class="custom-control-label">Có</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                                            {{ $category->active == 0 ? 'checked' : ''}}>
                                        <label for="no_active" class="custom-control-label">Không</label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
@endsection
@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'content' );
    </script>
@endsection
