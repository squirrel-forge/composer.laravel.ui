@php
    // Add typed modifier to fieldset.
    if (!empty($type)) $attributes = $attributes->merge(['class' => 'ui-fieldset--' . $type]);

    // Add legend modifier to fieldset.
    if (!empty($legend)) $attributes = $attributes->merge(['class' => 'ui-fieldset--legend']);
@endphp
<fieldset {!! $attributes->merge(['class' => 'ui-fieldset']) !!}>
    @if(!empty($legend))
        <legend class="ui-fieldset__legend">{!! $legend !!}</legend>
    @endif
    <div class="ui-fieldset__content">
        <{!! $wrapTag ?? 'div' !!} class="ui-wrap ui-wrap--fieldset{!! !empty($type) ? 'ui-wrap--fieldset-' . $type : '' !!} {{ $wrapClasses ?? '' }}">
            {!! $slot !!}
        </{!! $wrapTag ?? 'div' !!}>
        @if(!empty($required))
            <div class="ui-fieldset__required"><p><em>{!! $required !!}</em></p></div>
        @endif
    </div>
</fieldset>
