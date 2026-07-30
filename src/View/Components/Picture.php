<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui Picture
 */
class Picture extends UiComponent
{
    /** @var array $sources All picture sources. */
    public array $sources;

    /** @var array $image Default image. */
    public array $image;

    /**
     * Create a new component instance.
     */
    public function __construct(
        array $sources = [],
        array $image = [],
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'sources' => $sources,
            'image' => $image,
            'arbitrary' => $arbitrary,
        ]);
    }
}
