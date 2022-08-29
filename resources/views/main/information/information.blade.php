<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>{{ $title }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            @include('admin.alert ')
            @foreach($members as $member)
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <div type="text" class="form-control" name="name" id="name" placeholder="name">
                                Tên : {{ $member->name }}
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div type="email" class="form-control" name="email" id="email" placeholder="Email">
                                Email : {{ $member->email }}
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div type="text" class="form-control" name="address" id="address" placeholder="address">
                                Địa chỉ : {{ $member->address }}
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div type="text" class="form-control" name="phone" id="phone" placeholder="phone">
                                Số điện thoại : {{ $member->phone }}
                            </div>
                        </div>
                        <span>Đi tới trang chủ ? <a href="/">click</a></span>
                        <br>
                        <span>Đi tới lịch sử đặt hàng ? <a href="/history">click</a></span>
                        @csrf
                    </form>
                @endforeach
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

@include('admin.footer')
</body>
</html>
