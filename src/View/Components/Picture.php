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

    /**
     * Extend view data
     * @param array $data
     * @param string $componentName
     * @return void
     */
    protected function extendViewData(array &$data, string $componentName): void
    {
        // If sources is defined
        /* if (!empty($this->sources)) {

            // Check for anchor to maintain
            $anchor = '';
            $has_src = !empty($data['attributes']['src']);
            if ($has_src && mb_substr($data['attributes']['src'], 0, 1) == '#') {
                $anchor = $data['attributes']['src'];
            }

            // Only set asset, if no src or only anchor
            if (!$has_src || !empty($anchor)) {
                $data['attributes']['src'] = sqfAsset($this->asset, $this->relative, $this->cache, $this->secure) . $anchor;
            }

            // Resolve media references
            if (!empty($data['attributes']['media'])) {
                $data['attributes']['media'] = static::resolveMediaReference($data['attributes']['media']);
            }
        }
        */
    }
}
