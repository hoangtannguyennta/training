<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layouts.head')
</head>
<body>
    @include('admin.layouts.header')

    @yield('content')

    @include('admin.layouts.footer')

    @include('admin.layouts.js')
</body>
</html>