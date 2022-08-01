@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Nhập tên sản phẩm">
            </div>

            <div class="form-group">
                <label for="menu">Mô tả</label>
                <textarea name="description" class=form-control>{{$product->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Mô tả chi tiết</label>
                <textarea name="content" id="content" class=form-control>{{$product->content}}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Giá sản phẩm</label>
                <input type="text" class="form-control" name="price" value="{{$product->price}}" placeholder="Giá sản phẩm">
            </div>

            <div class="form-group">
                <label for="menu">Giá sản phẩm đã giảm giá</label>
                <input type="text" class="form-control" name="price_sale" value="{{$product->price_sale}}" placeholder="Giá sản phẩm đã giảm giá">
            </div>

            <div class="form-group">
                <label for="menu">Tổng sản phẩm</label>
                <input type="number" class="form-control" name="qty" value="{{$product->qty}}" placeholder="Tổng sản phẩm">
            </div>

            <div class="form-group">
                <label for="menu">Ảnh</label>
                <input type="file" class="form-control"  id="upload" value="{{ $product->file }}">
                <div id="image_show">
                    <a href="{{$product->file}}" target="_blank">
                        <img src="{{$product->file}}" width="100px">
                    </a>
                </div>
                <div id="image_show">

                </div>
                <input type="hidden" name="file" id="file" value="{{$product->file}}">
            </div>

            <div class="form-group">
                <label for="category">Danh mục</label>
                <select class="form-control" name="cate_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{$product->cate_id == $category->id ? 'selected' : ''}}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

            </div>


            <!-- /.card-body -->
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active"
                           name="active" {{$product->active == 1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active"
                           name="active" {{$product->active == 0 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">No</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
            </div>
        @csrf
    </form>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
