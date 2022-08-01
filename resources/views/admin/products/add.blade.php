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
                            <h3 class="card-title">Thêm sản phẩm</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select class="form-control" name="cate_id" id="cate_id">
                                        <option value="0">Danh mục cha</option>
                                        @foreach($products as $key => $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file[]" class="custom-file-input" id="upload" multiple />
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea type="text" class="form-control" id="description" name="description" value="{{old('description')}}" placeholder="Mô tả">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea type="text" class="form-control" id="content" name="content" value="{{old('content')}}" placeholder="Nội dung">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Giá sản phẩm</label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}" placeholder="Sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label>Giá giảm giá</label>
                                    <input type="text" class="form-control" id="price_sale" name="price_sale" value="{{old('price_sale')}}" placeholder="Sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="text" class="form-control" id="qty" name="qty" value="{{old('qty')}}" placeholder="Sản phẩm">
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
