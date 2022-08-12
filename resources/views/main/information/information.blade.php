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
            <form action="" method="post">
                <div class="input-group mb-3">
                    <div type="text" class="form-control" name="name" id="name" placeholder="name">
                        Tên :
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div type="email" class="form-control" name="email" id="email" placeholder="Email">
                        Email :
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div type="password" class="form-control" name="password" id="password" placeholder="Password">
                        Password :
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div type="text" class="form-control" name="address" id="address" placeholder="address">
                        Địa chỉ :
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div type="text" class="form-control" name="phone" id="phone" placeholder="phone">
                        Số điện thoại :
                    </div>
                </div>
                @csrf
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

@include('admin.footer')
</body>
</html>
