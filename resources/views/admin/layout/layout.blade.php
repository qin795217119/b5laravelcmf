<!DOCTYPE html>
<html>
@include('admin.layout.header')
<body class="gray-bg">
    <div class="container-div">
        <div class="row">
            @yield('content')
        </div>
    </div>
    @include('admin.layout.footer')
</body>
</html>
