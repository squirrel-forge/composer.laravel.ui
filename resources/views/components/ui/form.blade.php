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
<form
    is="ui-form"
    {!! $attributes->merge(['class' => 'ui-form'])->filter(fn ($value, $key) => !in_array($key, ['no-csrf'])) !!}
    action="{!! !empty($route) ? route($route, $params, $absolute) : '' !!}"
>
    @if(!isset($attributes['no-csrf']) || !in_array($attributes['no-csrf'], \SquirrelForge\LarUi\View\Components\Component::boolFalsy(['no-csrf'])))
        @csrf
    @endif
    @if($realMethod !== $attributes->get('method'))
        @method($realMethod)
    @endif
    @if(!isset($attributes['no-wrap']) || !in_array($attributes['no-wrap'], [0, false, 'false', 'off', 'no-wrap']))
    <div class="ui-wrap ui-wrap--form">
    @endif
        {!! $slot !!}
    @if(!isset($attributes['no-wrap']) || !in_array($attributes['no-wrap'], [0, false, 'false', 'off', 'no-wrap']))
    </div>
    @endif
</form>
