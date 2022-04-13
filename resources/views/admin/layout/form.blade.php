<!DOCTYPE html>
<html>
@include('admin.layout.header')
<body class="white-bg">
    <div class="wrapper wrapper-content animated fadeInRight ibox-content">
        @yield('content')
    </div>
    @include('admin.layout.footer')
</body>
</html>
