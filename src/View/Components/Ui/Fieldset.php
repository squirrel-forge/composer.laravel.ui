<?php

namespace SquirrelForge\Laravel\Ui\View\Components\Ui;

use SquirrelForge\Laravel\Ui\View\Components\UiComponent;

class Fieldset extends UiComponent
{
    public string $type;
    public ?string $legend;
    public ?string $required;
    public string $wrapper;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $type = 'default',
        string $legend = null,
        string $required = null,
        string $wrapper = 'div',
    )
    {
        parent::__construct();
        $this->type = $type;
        $this->legend = $legend;
        $this->required = $required;
        $this->wrapper = $wrapper;
    }
}
