<?php

namespace SquirrelForge\Laravel\Ui\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Provider;

/**
 * Module service provider
 */
class ServiceProvider extends Provider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {}

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $base_dir = dirname(__DIR__, 2);

        // Load translations
        $lang_src = implode(DIRECTORY_SEPARATOR, [$base_dir, 'resources', 'lang', '']);
        $this->loadTranslationsFrom($lang_src, 'sqf-ui' );

        // Publish translations
        $this->publishes([$lang_src => lang_path('vendor/sqf-ui')], ['sqf-ui', 'lang']);

        // Load views
        $view_src = implode(DIRECTORY_SEPARATOR, [$base_dir, 'resources', 'views', '']);
        $this->loadViewsFrom($view_src, 'sqf-ui');

        // Publish views
        $this->publishes([$view_src => resource_path('views/vendor/sqf-ui')], ['sqf-ui', 'views']);

        // Publish configs
        $config_src = implode(DIRECTORY_SEPARATOR, [$base_dir, 'resources', 'config', '']);
        $this->publishes([$config_src . 'config.php' => config_path('sqf-ui.php')], ['sqf-ui', 'config']);

        // Publish public assets
        // $public_src = implode(DIRECTORY_SEPARATOR, [$base_dir, 'resources', 'public', '']);
        // $this->publishes([$public_src => public_path('vendor/sqf-ui')], 'public');

        // Components
        Blade::componentNamespace('SquirrelForge\\Laravel\\Ui\\View\\Components', 'sqf-ui');
    }
}
