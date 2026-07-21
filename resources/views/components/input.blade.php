@php
    $_internal_wrap_classes = 'ui-input ui-input--' . $attributes['type'] . ($_internal_wrap_classes ?? '');
    if (!empty($attributes->get('required'))) {
        $_internal_wrap_classes .= ' ui-input--required';
    }
    if (!$noErrors && $bind && empty($errorMessages)) {
        $errorMessages = \SquirrelForge\Laravel\Ui\View\Components\Input::getFieldErrors($attributes['name']);
    }
    if (!empty($errorMessages)) {
        $_internal_wrap_classes .= ' ui-input--error ui-input--error-visible';
    }
@endphp
<label {!! $attributes->merge(['class' => $_internal_wrap_classes])->filter(fn ($value, $key) => $key === 'class') !!}>
    @if(!empty($label) && !\SquirrelForge\Laravel\Ui\View\Components\UiComponent::isTruthy($labelAfter, ['label-after']))
        <{!! $labelTag ?? 'strong' !!} class="ui-input__label {{ $labelClasses }}">{!! $label !!}</{!! $labelTag ?? 'strong' !!}>
    @endif
    <span class="ui-input__input">
        @if($attributes['type'] === 'select')
            @php
                $selectedValue = $attributes['value'] ?? null;
                $attributes['type'] = null;
                $attributes['value'] = null;
            @endphp
            <select {!! $attributes->filter(fn ($value, $key) => $key !== 'class') !!}>
                @if($slot->isEmpty() && !empty($dataList))
                    @foreach($dataList as $_internal_data_list_key => $_internal_data_list_value)
                        <option value="{{ is_string($_internal_data_list_key) ? $_internal_data_list_key : $_internal_data_list_value }}"
                            {!! $selectedValue === (is_string($_internal_data_list_key) ? $_internal_data_list_key : $_internal_data_list_value) ? ' selected' : '' !!}>{{ $_internal_data_list_value }}</option>
                    @endforeach
                @else
                    {!! $slot !!}
                @endif
            </select>
            @if(in_array($attributes['type'], \SquirrelForge\Laravel\Ui\View\Components\Input::$hasPseudo))
                <span class="ui-input__pseudo">
                    @if (isset($pseudo) && !$pseudo->isEmpty())
                        {!! $pseudo !!}
                    @elseif(!empty($pseudoIcon))
                        <span class="ui-icon {{ $iconClasses ?? '' }}" data-icon="{{ $pseudoIcon }}"></span>
                    @endif
                </span>
            @endif
        @elseif($attributes['type'] === 'textarea')
            @php
                $textAreaValue = $attributes['value'] ?? '';
                $attributes['type'] = null;
                $attributes['value'] = null;
            @endphp
            <textarea {!! $attributes->filter(fn ($value, $key) => $key !== 'class') !!}>{{ $textAreaValue }}</textarea>
        @else
            <input {!! $attributes->filter(fn ($value, $key) => $key !== 'class') !!} />
            @if(in_array($attributes['type'], \SquirrelForge\Laravel\Ui\View\Components\Input::$hasPseudo))
                <span class="ui-input__pseudo">
                    @if(isset($pseudo) && !$pseudo->isEmpty())
                        {!! $pseudo !!}
                    @elseif(!empty($pseudoIcon))
                        <span class="ui-icon {{ $iconClasses ?? '' }}" data-icon="{{ $pseudoIcon }}"></span>
                    @endif
                </span>
            @endif
            @if(!empty($dataList) && !empty($attributes['list']))
                <datalist id="{{ $attributes['list'] }}">
                    @foreach($dataList as $_internal_data_list_key => $_internal_data_list_value)
                        <option value="{{ is_string($_internal_data_list_key) ? $_internal_data_list_key : $_internal_data_list_value }}">{{ $_internal_data_list_value }}</option>
                    @endforeach
                </datalist>
            @endif
        @endif
    </span>
    @if(!empty($label) && \SquirrelForge\Laravel\Ui\View\Components\UiComponent::isTruthy($labelAfter, ['label-after']))
        <{!! $labelTag ?? 'strong' !!} class="ui-input__label {{ $labelClasses }}">{!! $label !!}</{!! $labelTag ?? 'strong' !!}>
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
