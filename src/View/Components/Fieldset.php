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

    /** @var string $wrapTag Set inner wrapping tag type, default: div */
    public string $wrapTag;

    /** @var string $wrapClasses Set inner wrapping classes. */
    public string $wrapClasses;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $type = '',
        string $legend = '',
        string $required = '',
        string $wrapTag = 'div',
        string $wrapClasses = '',
    ) {
        $this->setProperties([
            'type' => $type,
            'legend' => $legend,
            'required' => $required,
            'wrapTag' => $wrapTag,
            'wrapClasses' => $wrapClasses,
        ]);
    }
}
