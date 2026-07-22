@php
    // Set default method "post"
    if (empty($attributes->get('method'))) {
        $attributes = $attributes->merge(['method' => 'post']);
    }

    // Save real method for laravel form method spoofing
    $realMethod = $attributes->get('method');
    if (in_array($realMethod, ['put', 'patch', 'delete'])) {
        $attributes['method'] = 'post';
    }

    // Default multipart data if not set
    if (isset($files) && $files && empty($attributes->get('enctype'))) {
        $attributes = $attributes->merge(['enctype' => 'multipart/form-data']);
    }
@endphp
<form is="ui-form" {!! $attributes->merge(['class' => 'ui-form']) !!}>
    @if(!SqfUi::isTruthy($noCsrf, ['no-csrf']))
        @csrf
    @endif
    @if($realMethod !== $attributes->get('method'))
        @method($realMethod)
    @endif
    @if(!SqfUi::isTruthy($noWrap, ['no-wrap']))
    <{!! $wrapTag ?? 'div' !!} class="ui-wrap ui-wrap--form {{ $wrapClasses ?? '' }}">
    @endif
        {!! $slot !!}
    @if(!SqfUi::isTruthy($noWrap, ['no-wrap']))
    </{!! $wrapTag ?? 'div' !!}>
    @endif
</form>
