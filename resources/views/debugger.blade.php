@push('scripts')
    <script type="text/javascript" src="{{ asset('js/sqf-ui-debugger.min.js') }}" async fetchpriority="low"></script>
@endpush
<x-sqf-ui::button
        id="sqf-ui-debugger-opener"
        data-modal-id="sqf-ui-debugger"
        data-modal="ctrl:open"
        class="ui-button--label-hidden"
        icon-before="debug"
        label="Show UI Debugger"
        data-ph="center"
        data-pv="top"
/>
<x-sqf-ui::modal id="sqf-ui-debugger" title="squirrel-forge ui debugger" no-footer-controls>
    @foreach(\SquirrelForge\Laravel\Ui\Facades\SqfUi::getVersions() as $name => $version)
        <p>{{ $name }} {{ $version }}</p>
    @endforeach
    <figure>
        <code>@dump([
            'LOCALE' => app()->currentLocale(),
            'USER' => Auth::user()?->toArray(),
            'SESSION' => ['ID' => session()->getId(), 'DATA' => session()->all()],
        ])</code>
        <figcaption>
            <x-sqf-ui::button
                    icon-before="refresh"
                    label="Refresh state information"
            />
        </figcaption>
    </figure>

    <x-sqf-ui::fieldset type="options" legend="Options">
        <x-sqf-ui::input class="ui-input--wide" type="checkbox" name="debug[css]" label="CSS debug" label-after pseudo-icon="check" />
        <x-sqf-ui::input class="ui-input--wide" type="checkbox" name="debug[js]" label="JS debug" label-after pseudo-icon="check" />
        <x-sqf-ui::input class="ui-input--wide" type="select" name="debug[ph]" label="Horizontal">
            <option value="left">Left</option>
            <option value="center">Center</option>
            <option value="right">Right</option>
        </x-sqf-ui::input>
        <x-sqf-ui::input class="ui-input--wide" type="select" name="debug[pv]" label="Vertical">
            <option value="top">Top</option>
            <option value="center">Center</option>
            <option value="bottom">Bottom</option>
        </x-sqf-ui::input>
    </x-sqf-ui::fieldset>

    <x-slot:footer>
        <div class="ui-modal__dialog-controls">

        </div>
    </x-slot:footer>
</x-sqf-ui::modal>
