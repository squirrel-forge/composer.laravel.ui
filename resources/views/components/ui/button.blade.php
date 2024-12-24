<{!! !empty($attributes->get('href')) ? 'a' : 'button' !!} {!! $attributes->merge(['class' => 'ui-button']) !!}>
    <span class="ui-button__label">{!! $label !!}</span>
</{!! !empty($attributes->get('href')) ? 'a' : 'button' !!}>
