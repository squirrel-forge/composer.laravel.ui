<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui Fieldset
 */
class Fieldset extends UiComponent
{
    /** @var string $type Adds a BEM style class modifier. */
    public string $type;

    /** @var string $legend Set a legend. */
    public string $legend;

    /** @var string $required Set a required text */
    public string $required;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $type = '',
        string $legend = '',
        string $required = '',
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'type' => $type,
            'legend' => $legend,
            'required' => $required,
            'arbitrary' => $arbitrary,
        ]);
    }
}
