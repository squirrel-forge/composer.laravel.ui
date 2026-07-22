<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui Picture
 */
class Picture extends UiComponent
{
    /** @var array $sources All picture sources. */
    public array $sources;

    /**
     * Create a new component instance.
     */
    public function __construct(
        array $sources = [],
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'sources' => $sources,
            'arbitrary' => $arbitrary,
        ]);
    }
}
