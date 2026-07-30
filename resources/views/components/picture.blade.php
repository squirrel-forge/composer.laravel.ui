<picture {!! $attributes->merge(['class' => 'ui-fluid-picture']) !!}>
    @foreach($sources as $arbitrary)
        <x-sqf-ui::source :$arbitrary />
    @endforeach
    @if(!empty($image))
        <x-sqf-ui::img :arbitrary="$image" />
    @endif
    {!! $slot !!}
</picture>
