@extends('admin.main')

@section('content')
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th width="150px">Xem các đánh giá</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($list_pro_reviews as $key => $pro_review)
                        @if(isset($pro_review->reviews[0]))
                        <tr>
                            <td>{{ $pro_review->id }}</td>
                            <td><img src="{{ $pro_review->file }}" alt="" width="60px"></td>
                            <td>{{ $pro_review->name }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/admin/reviews/review_detail/{{$pro_review->id}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
