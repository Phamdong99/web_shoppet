@extends('admin.main')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập tên">
            </div>

            <div class="form-group">
                <label for="menu">Mô tả</label>
                <textarea name="description" value="{{old('description')}}" class=form-control></textarea>
            </div>

            <div class="form-group">
                <label for="menu">Mô tả chi tiết</label>
                <textarea name="content" id="content" value="{{old('content')}}" class=form-control></textarea>
            </div>

            <div class="form-group">
                <label for="category">Danh mục</label>
                <select class="form-control" name="cate_id">
                    <option value="0"> Danh mục </option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>

            </div>
{{--------------Add size add price--}}
            <div class="card">
                <table class="wrapper_size" width="100%">
                    <thead>
                    <tr>
                        <td style="margin-left: 100px" width="20%" colspan="4"><span class="add_field_button btn btn-primary">Thêm size</span></td>
                    </tr>
                    </thead>
                    <tbody class="container">
                    <tr>
                        <td width="90%">
                            <label>Nhập size : </label>
                            <input type="text" name="size[]" value="{{old('size')}}"placeholder="Nhập size cho sản phẩm"/>
                            <label>Nhập giá : </label>
                            <input type="number" name="price[]" value="{{old('price')}}" placeholder="Nhập giá theo size"/>
                            <label>Nhập số lượng : </label>
                            <input type="number" name="qty[]" value="{{old('qty')}}" placeholder="Nhập số lượng"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
{{--            ----------------}}
            <br>
{{--            <div class="form-group">--}}
{{--                <label for="menu">Giá sản phẩm</label>--}}
{{--                <input type="text" class="form-control" name="price"  value="{{old('price')}}" placeholder="Giá sản phẩm">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="menu">Giá sản phẩm đã giảm giá</label>--}}
{{--                <input type="text" class="form-control" name="price_sale" value="{{old('price_sale')}}" placeholder="Giá sản phẩm đã giảm giá">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label>Tổng số lượng</label>--}}
{{--                <input type="number" class="form-control" name="qty" value="" placeholder="Nhập số lượng">--}}
{{--            </div>--}}

            <div class="form-group">
                <label for="menu">Ảnh</label>
                <input type="file" class="form-control"  id="upload" multiple >
                <div id="image_show">

                </div>
                <input type="hidden" name="file" id="file">
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
                <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
            </div>
        @csrf
    </form>
@endsection

