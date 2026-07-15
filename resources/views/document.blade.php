<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@yield('page_first','')
@stack('preload')
{!! \SquirrelForge\Laravel\Ui\Facades\SqfUi::metaTags() !!}
@yield('page_meta','')
@stack('styles')
@yield('page_head','')
</head>
<body {!! \SquirrelForge\Laravel\Ui\Facades\SqfUi::bodyAttributes() !!}>
@yield('page_before','')
@yield('page_content')
@yield('page_after','')
@yield('page_end','')
@stack('scripts')
@yield('page_final','')
</body>
</html>
