@php
    $attributes = $attributes->merge([

        // Video sources
        'data-sources' => json_encode($sources),

        // Selected default source
        'data-selected' => $selected ?? 0,

        // Set native video controls
        'data-native' => !isset($noNative) || !\SquirrelForge\Laravel\Ui\Facades\SqfUi::isTruthy($noNative, ['no-native']) ? 'true' : 'false',

        'preload' => $preload,

        'playsinline' => !\SquirrelForge\Laravel\Ui\Facades\SqfUi::isTruthy($notPlaysinline, ['not-playsinline']),
    ]);
@endphp
<div is="ui-video" {!! $attributes->merge(['class' => 'ui-video'])->filter(fn ($value, $key) => $key === 'class' || mb_substr($key, 0, 5) === 'data-') !!}>
    <div class="ui-video__wrap">
        <div class="ui-video__ratio" data-state-default="{{ __('sqf-ui::video.loading') }}">
            @if(!isset($noControls) || !SqfUi::isTruthy($noControls, ['no-controls']))
                <div class="ui-video__controls">
                    <button class="ui-video__button ui-video__button--main ui-video__button--play" type="button" data-video="ctrl:play">
                        @if(isset($iconPlay) && !$iconPlay->isEmpty())
                            {!! $iconPlay !!}
                        @else
                            <span class="ui-video__icon" data-icon="play"></span>
                        @endif
                        <span class="ui-video__label ui-video__a11yhide">{{ __('sqf-ui::video.controls.play') }}</span>
                    </button>
                    <button class="ui-video__button ui-video__button--main ui-video__button--pause" type="button" data-video="ctrl:pause">
                        @if(isset($iconPause) && !$iconPause->isEmpty())
                            {!! $iconPause !!}
                        @else
                            <span class="ui-video__icon" data-icon="pause"></span>
                        @endif
                        <span class="ui-video__label ui-video__a11yhide">{{ __('sqf-ui::video.controls.pause') }}</span>
                    </button>
                    <button class="ui-video__button ui-video__button--main ui-video__button--replay" type="button" data-video="ctrl:replay">
                        @if(isset($iconReplay) && !$iconReplay->isEmpty())
                            {!! $iconReplay !!}
                        @else
                            <span class="ui-video__icon" data-icon="replay"></span>
                        @endif
                        <span class="ui-video__label ui-video__a11yhide">{{ __('sqf-ui::video.controls.replay') }}</span>
                    </button>
                </div>
            @endif
            <video class="ui-video__player" {!! $attributes->filter(fn ($value, $key) => $key !== 'class' && mb_substr($key, 0, 5) !== 'data-') !!}>{!! $slot !!}</video>
            <div class="ui-video__loading"></div>
            <div class="ui-video__state ui-video__state--error">
                @if(isset($error) && !$error->isEmpty())
                    {!! $error !!}
                @else
                    {!! __('sqf-ui::video.error') !!}
               @endif
            </div>
        </div>
    </div>
</div>
