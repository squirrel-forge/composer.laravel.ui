<?php

namespace SquirrelForge\Laravel\Ui\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Provider;
use SquirrelForge\Laravel\Ui\View\Components\Button;
use SquirrelForge\Laravel\Ui\View\Components\Fieldset;
use SquirrelForge\Laravel\Ui\View\Components\Form;

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

        // Load views
        $view_src = implode(DIRECTORY_SEPARATOR, [$base_dir, 'resources', 'views', '']);
        $this->loadViewsFrom($view_src, 'sqf-ui');

        // Publish views
        $this->publishes([$view_src => resource_path('views/vendor/sqf-ui')], 'views');

        // Publish configs
        $config_src = implode(DIRECTORY_SEPARATOR, [$base_dir, 'resources', 'config', '']);
        $this->publishes([$config_src . 'config.php' => config_path('sqf-ui.php')], 'config');

        // Publish public assets
        $public_src = implode(DIRECTORY_SEPARATOR, [$base_dir, 'resources', 'public', '']);
        $this->publishes([$public_src => public_path('vendor/sqf-ui')], 'public');

        // Components
        Blade::component('sqf-ui::button', Button::class);
        Blade::component('sqf-ui::fieldset', Fieldset::class);
        Blade::component('sqf-ui::form', Form::class);
    }
}
