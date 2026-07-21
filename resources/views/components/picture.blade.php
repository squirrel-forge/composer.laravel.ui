<picture {!! $attributes->merge(['class' => 'ui-fluid-picture']) !!}>
    @foreach($sources as $arbitrary)
        <x-sqf-ui::source :$arbitrary />
    @endforeach
    {!! $slot !!}
</picture>
