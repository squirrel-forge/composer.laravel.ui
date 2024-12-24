@php
    if (!empty($type)) $attributes = $attributes->merge(['class' => 'ui-fieldset--' . $type]);
    if (!empty($legend)) $attributes = $attributes->merge(['class' => 'ui-fieldset--legend']);
@endphp
<fieldset {!! $attributes->merge(['class' => 'ui-fieldset']) !!}>
    @if(!empty($legend))
        <legend class="ui-fieldset__legend">{!! $legend !!}</legend>
    @endif
    <div class="ui-fieldset__content">
        <{!! $wrapper ?? 'div' !!} class="ui-wrap ui-wrap--fieldset">
            {!! $slot !!}
        </{!! $wrapper ?? 'div' !!}>
        @if(!empty($required))
            <div class="ui-fieldset__required"><p><em>{!! $required !!}</em></p></div>
        @endif
    </div>
</fieldset>
