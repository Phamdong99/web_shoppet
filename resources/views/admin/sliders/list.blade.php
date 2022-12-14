@extends('admin.main')

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-lg">
                <a href="/admin/sliders/add" style="color: white">Thêm mới</a></button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">ID</th>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Url</th>
                    <th>Vị trí</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sliders as $key => $slider)
                    <tr>
                        <td>{{ $slider->id }}</td>
                        <td><img src="{{ $slider->file }}" alt="" width="60px"></td>
                        <td>{{ $slider->name }}</td>
                        <td>{{ $slider->url }}</td>
                        <td>{{ $slider->sort_by }}</td>
                        <td>{!! \App\Helper\Helper::active($slider->active) !!} </td>


                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{$slider->id}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#"
                               onclick="removeRow({{$slider->id}}, '/admin/sliders/destroy')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
