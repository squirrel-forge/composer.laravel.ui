<{!! $tag ?? 'ol' !!} is="ui-accordion" {!! $attributes->merge(['class' => 'ui-button']) !!}>
    @foreach($panels as $panel)
        <x-sqf-ui::accordion.panel :arbitrary="$panel->attributes ?? []">
            {{ $panel->text ?? '' }}{!! $panel->html ?? $panel->content ?? $panel->slot !!}
        </x-sqf-ui::accordion.panel>
    @endforeach
    {!! $slot !!}
</{!! $tag ?? 'ol' !!}>
