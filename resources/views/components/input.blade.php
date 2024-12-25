@php
    $wrapperClasses = ['ui-input', 'ui-input--' . $attributes->get('type')];
    if (!empty($attributes->get('required'))) {
        $wrapperClasses[] = 'ui-input--required';
    }
    if (!empty($fieldErrors)) {
        $wrapperClasses[] = 'ui-input--error';
        $wrapperClasses[] = 'ui-input--error-visible';
    }
@endphp
<label class="{!! join(' ', $wrapperClasses) !!}">
    @if(!empty($label) && !$labelAfter)
        <{!! $labelTag ?? 'strong' !!} class="ui-input__label">{!! $label !!}</{!! $labelTag ?? 'strong' !!}>
    @endif
    <span class="ui-input__input">
        @if($attributes->get('type') === 'select')
            @php $attributes['type'] = null; @endphp
            <select {!! $attributes !!}>
                {!! $slot !!}
            </select>
        @else
            <input {!! $attributes !!} />
            @if(!empty($dataList) && !empty($attributes['list']))
                <datalist id="{{ $attributes['list'] }}">
                    @foreach($dataList as $dlK => $dlV)
                        <option value="{{ is_string($dlK) ? $dlK : $dlV }}">{{ $dlV }}</option>
                    @endforeach
                </datalist>
            @endif
        @endif
    </span>
    @if(!empty($label) && $labelAfter)
        <{!! $labelTag ?? 'strong' !!} class="ui-input__label">{!! $label !!}</{!! $labelTag ?? 'strong' !!}>
    @endif
    <{!! $errorTag ?? 'em' !!} class="ui-input__error">
    @if(!empty($errorMessages))
        <ul>
        @foreach($errorMessages as $errorMessage)
            <li>{!! $errorMessage !!}</li>
        @endforeach
        </ul>
    @endif
    </{!! $errorTag ?? 'em' !!}>
</label>
