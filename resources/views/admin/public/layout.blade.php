<!DOCTYPE html>
<html>
@include('admin.public.header')
<body class="gray-bg">
    <div class="container-div">
        <div class="row">
            @yield('content')
        </div>
    </div>
    @include('admin.public.footer')
</body>
</html>
