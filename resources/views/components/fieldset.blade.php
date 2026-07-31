@php
    // Add typed modifier to fieldset.
    if (!empty($type)) $attributes = $attributes->merge(['class' => 'ui-fieldset--' . $type]);

    // Add legend modifier to fieldset.
    if (!empty($legend)) $attributes = $attributes->merge(['class' => 'ui-fieldset--legend']);
@endphp
@props(['wrapped'])
<fieldset {!! $attributes->merge(['class' => 'ui-fieldset']) !!}>
    @if(!empty($legend))
        <legend class="ui-fieldset__legend">{!! $legend !!}</legend>
    @endif
    <div class="ui-fieldset__content">
        @if(isset($wrapped) && !$wrapped->isEmpty())
            <div {!! $wrapped->attributes->merge(['class' => 'ui-wrap ui-wrap--fieldset ui-wrap--fieldset-' . $type]) !!}>
                {!! $wrapped !!}
            </div>
        @endif
        {!! $slot !!}
        @if(!empty($required))
            <div class="ui-fieldset__required">{!! $required !!}</div>
        @endif
    </div>
</fieldset>
