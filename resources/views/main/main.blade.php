<!DOCTYPE html>
<html lang="en">
<head>
    @include('main.head')
</head>
<body>

<!-- Header -->
@include('main.header')

<!-- Cart -->
@include('main.cart')

@yield('content')


@include('main.footer')

</body>
</html>
