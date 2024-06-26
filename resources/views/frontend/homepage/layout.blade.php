<!DOCTYPE html>
<html lang="en">
@include('frontend.component.head')

<body>
    @include('frontend.component.header')
    @yield('content')
    @include('frontend.component.footer')
    @include('frontend.component.popup')
    @include('frontend.component.script')
</body>

</html>