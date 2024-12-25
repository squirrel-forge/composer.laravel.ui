<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @yield('page_first','')
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
