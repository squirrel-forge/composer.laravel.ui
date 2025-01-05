@php
    // Add icon modifier if an icon is set
    if (!empty($iconBefore) || !empty($iconAfter)) $attributes = $attributes->merge(['class' => 'ui-button--icon']);

    // Add no label modifier if no label is set
    if (empty($label) || isset($slot) && $slot->isEmpty()) $attributes = $attributes->merge(['class' => 'ui-button--label-none']);
@endphp
<{!! !empty($attributes->get('href')) ? 'a' : 'button' !!} {!! $attributes->merge(['class' => 'ui-button']) !!}>
    @if(!empty($iconBefore))
        <span class="ui-icon {{ $iconBeforeClasses ?? '' }}" data-icon="{{ $iconBefore }}"></span>
    @endif
    @if(!empty($label) || isset($slot) && !$slot->isEmpty())
        <span class="ui-button__label">{!! $label ?? '' !!}{!! $slot !!}</span>
    @endif
    @if(!empty($iconAfter))
        <span class="ui-icon {{ $iconAfterClasses ?? '' }}" data-icon="{{ $iconAfter }}"></span>
    @endif
</{!! !empty($attributes->get('href')) ? 'a' : 'button' !!}>
