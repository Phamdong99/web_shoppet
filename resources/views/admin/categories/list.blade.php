@extends('admin.main')

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-lg">
                <a href="/admin/categories/add" style="color: white">Thêm mới</a></button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">ID</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th>ảNH</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                   @foreach($categories as $key => $category)
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->parent_id}}</td>
                        <td>{{$category->file}}</td>
                        <td>{{$category->active}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/categories/employee_detail/{{ $category->id }} ">
                                <i class="far fa-eye"></i>
                            </a>

                            <a class="btn btn-primary btn-sm" href="/admin/categories/edit/{{ $category->id }} ">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-sm"
                               onclick="removeRow({{ $category->id }}, '/admin/categories/destroy')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                       @endforeach
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th width="5px">ID</th>
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th>ảNH</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
