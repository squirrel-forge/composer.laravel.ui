<?php

namespace SquirrelForge\Laravel\Ui\View\Components\Ui;

use SquirrelForge\Laravel\Ui\View\Components\UiComponent;

class Button extends UiComponent
{
    public ?string $label;
    public ?string $route;
    public ?array $params;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $label = null,
        string $route = null,
        array $params = null,
    ) {
        parent::__construct();
        $this->label = $label;
        $this->route = $route;
        $this->params = $params;
    }

    protected function extendViewData(array &$data, string $componentName): void
    {
        if (!empty($this->route) && empty($data['attributes']['href'])) {
            $data['attributes']['href'] = route($this->route, $this->params ?? []);
        }
    }
}
