@php
    // Enforce valid mode
    if (empty($mode)) $mode = 'modal';

    // Add scroll class and mode attribute
    $isOuterScroll = SqfUi::isTruthy($outerScroll, ['outer-scroll']);
    $attributes = $attributes->merge([
        'class' => 'ui-modal--' . ($isOuterScroll ? 'outer' : 'inner') . '-scroll',
        'data-mode' => $mode,
    ]);
@endphp
{{-- Component markup --}}
<section {!! $attributes->merge(['class' => 'ui-modal', 'is' => 'ui-modal']) !!}>
    <div class="ui-modal__wrap" {!! $isOuterScroll ? 'tabindex="0"' : '' !!}>
        <dialog class="ui-modal__dialog">
            @if(!SqfUi::isTruthy($noHeader, ['no-header']))
                <div class="ui-modal__dialog-header">
                    @if(!empty($title))
                        <h3 class="ui-modal__dialog-title">{!! $title !!}</h3>
                    @endif
                    @if(isset($header) && !$header->isEmpty())
                        {!! $header !!}
                    @endif
                    @if(!SqfUi::isTruthy($noHeaderControls, ['no-header-controls']))
                        <div class="ui-modal__dialog-controls">
                            <x-sqf-ui::button
                                data-modal="ctrl:close"
                                class="ui-button--label-hidden ui-modal__button ui-modal__button--close"
                                icon-before="close"
                                :label="__('sqf-ui.modal.buttons.close')"
                            />
                        </div>
                    @endif
                </div>
            @endif
        @if(!$isOuterScroll)
            <div class="ui-modal__dialog-scrollable" tabindex="0">
        @else
            <div class="ui-modal__dialog-wrap">
        @endif
                <div class="ui-modal__dialog-content">
                    @if(isset($slot) && !$slot->isEmpty())
                        {!! $slot !!}
                    @endif
                </div>
            </div>
            @if(!SqfUi::isTruthy($noFooter, ['no-footer']))
                <div class="ui-modal__dialog-footer">
                    @if(isset($footer) && !$footer->isEmpty())
                        {!! $footer !!}
                    @endif
                    @if(!SqfUi::isTruthy($noFooterControls, ['no-footer-controls']))
                        <div class="ui-modal__dialog-controls">
                            @if($mode == 'modal')
                                <x-sqf-ui::button
                                    data-modal="ctrl:close"
                                    class="ui-modal__button ui-modal__button--close"
                                    icon-before="close-small"
                                    :label="__('sqf-ms.modal.buttons.close')"
                                />
                            @elseif($mode == 'alert')
                                <x-sqf-ui::button
                                    data-modal="ctrl:close"
                                    class="ui-modal__button ui-modal__button--ok"
                                    icon-before="check"
                                    :label="__('sqf-ms.modal.buttons.ok')"
                                />
                            @elseif($mode == 'confirm' || $mode == 'prompt')
                                <x-sqf-ui::button
                                    data-modal="ctrl:close"
                                    class="ui-modal__button ui-modal__button--cancel"
                                    icon-before="close-small"
                                    :label="__('sqf-ms.modal.buttons.cancel')"
                                />
                                <x-sqf-ui::button
                                    :data-modal="'ctrl:' . $mode . '.confirm'"
                                    class="ui-modal__button ui-modal__button--confirm"
                                    icon-before="check"
                                    :label="__('sqf-ms.modal.buttons.confirm')"
                                />
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </dialog>
    </div>
</section>
