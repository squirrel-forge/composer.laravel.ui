<{!! $tag ?? 'li' !!} class="ui-accordion__item">
    <details is="ui-accordion-panel" {!! $attributes->merge(['class' => 'ui-accordion__panel']) !!}>
        <summary class="ui-accordion__summary">
            <button class="ui-accordion__trigger" type="button" tabindex="-1" style="pointer-events:none">
                <span class="ui-accordion__icon">@if(isset($icon) && !$icon->isEmpty()){!! $icon !!}@endif</span>
                <span class="ui-accordion__label">{!! $label ?? '' !!}</span>
            </button>
        </summary>
        <div class="ui-accordion__content">
            <div class="ui-accordion__wrap">
                {!! $slot !!}
            </div>
        </div>
    </details>
</{!! $tag ?? 'li' !!}>
