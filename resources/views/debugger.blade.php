<dialog open>
    <p><strong>Locale:</strong> <em>{!! app()->currentLocale() !!}</em></p>
    <p><strong>Params:</strong></p>
    <pre><code>GET {!! var_export($_GET, true) !!}</code></pre>
    <pre><code>POST {!! var_export($_POST, true) !!}</code></pre>
    <p><strong>User:</strong></p>
    <pre><code>{!! var_export(Auth::user()?->toArray(), true) !!}</code></pre>
    <p><strong>Session:</strong></p>
    <pre><code>{!! var_export(session()->all(), true) !!}</code></pre>
    <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
</dialog>
