<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui slidable
 */
class Slidable extends UiComponent
{
    /** @var bool $hidden Container is hidden */
    public bool $hidden;

    /**
     * Create a new component instance.
     */
    public function __construct(
        bool $hidden = false,
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'hidden' => $hidden,
            'arbitrary' => $arbitrary,
        ]);
    }

    /**
     * Extend view data
     * @param array $data
     * @param string $componentName
     * @return void
     */
    protected function extendViewData(array &$data, string $componentName): void
    {
        // If container is hidden
        if ($this->hidden) {

            $data['attributes']['aria-hidden'] = 'true';
            if (empty($data['attributes']['style'])) $data['attributes']['style'] = 'display:none';
        }
    }
}
