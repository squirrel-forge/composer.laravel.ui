<dialog open>
    <h4>squirrel-forge ui debugger</h4>
    <p>sqf-ui v{{ \SquirrelForge\Laravel\Ui\Service::VERSION }}</p>
    <code>@dump([
        'LOCALE' => app()->currentLocale(),
        'USER' => Auth::user()?->toArray(),
        'SESSION' => ['ID' => session()->getId(), 'DATA' => session()->all()],
    ])</code>
    <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
</dialog>
