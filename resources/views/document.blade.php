<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport">
    @yield('page_meta','')
    @stack('styles')
</head>
<body>
@yield('page_before','')
@yield('page_content')
@yield('page_after','')
@yield('page_end','')
@stack('scripts')
@include('sqf-ui::debugger')
</body>
</html>
