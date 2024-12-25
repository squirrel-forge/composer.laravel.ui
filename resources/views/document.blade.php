<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    {!! SqfUi::metaTags() !!}
    @yield('page_meta','')
    @stack('styles')
    @yield('page_head','')
</head>
<body {!! SqfUi::bodyAttributes() !!}>
@yield('page_before','')
@yield('page_content')
@yield('page_after','')
@yield('page_end','')
@stack('scripts')
@include('sqf-ui::debugger')
@yield('page_final','')
</body>
</html>
