@php
    use \Illuminate\Support\Facades\Auth as Auth;
@endphp
    <!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @yield('style')
    @include('layouts.style')

</head>
<body class="sidebar-fixed sidebar-dark header-fixed header-light" id="body">
<div class="mobile-sticky-body-overlay"></div>
<div class="wrapper">
        @include('layouts.slide_bar')
        <div class="page-wrapper">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
        </div>
</div>

</body>
@include('layouts.script')
<script>
    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@yield('script')
</html>

