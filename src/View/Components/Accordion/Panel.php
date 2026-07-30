<?php

namespace SquirrelForge\Laravel\Ui\View\Components\Accordion;

use SquirrelForge\Laravel\Ui\View\Components\UiComponent;

/**
 * Ui Accordion Panel
 */
class Panel extends UiComponent
{
    /** @var string $tag HTML Tag type, default: <li> */
    public string $tag;

    /** @var string $label Button label text. */
    public string $label;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $tag = 'li',
        string $label = '',
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'tag' => $tag,
            'label' => $label,
            'arbitrary' => $arbitrary,
        ]);
    }
}
