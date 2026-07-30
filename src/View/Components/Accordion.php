<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui Accordion
 */
class Accordion extends UiComponent
{
    /** @var string $tag HTML Tag type, default: <ol> */
    public string $tag;

    /** @var array $panels All panel sources. */
    public array $panels;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $tag = 'ol',
        array $panels = [],
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'tag' => $tag,
            'panels' => $panels,
            'arbitrary' => $arbitrary,
        ]);
    }
}
