<?php

namespace SquirrelForge\Laravel\Ui\View\Components\Ui;

use SquirrelForge\Laravel\Ui\View\Components\UiComponent;

class Form extends UiComponent
{
    public string $route;
    public array $params;
    public bool $absolute;
    public bool $files;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $route = '',
        array $params = [],
        bool $absolute = false,
        bool $files = false,
    ) {
        parent::__construct();
        $this->files = $files;
        $this->route = $route;
        $this->absolute = $absolute;
        $this->params = $params;
    }
}
