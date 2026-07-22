<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

use SquirrelForge\Laravel\Ui\Facades\SqfUi;

/**
 * Ui Source
 */
class Source extends UiComponent
{
    /** @var string $asset Generates src for given asset. */
    public string $asset;

    /** @var bool $absolute Absolute asset path. */
    public bool $absolute;

    /** @var bool $cache Do not append cache breaker to asset. */
    public bool $cache;

    /** @var bool $notSecure Do not use https if absolute. */
    public bool $notSecure;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $asset = '',
        bool $absolute = false,
        bool $cache = false,
        bool $notSecure = false,
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'asset' => $asset,
            'absolute' => $absolute,
            'cache' => $cache,
            'notSecure' => $notSecure,
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
        // If asset is defined
        if (!empty($this->asset)) {

            // Check for anchor to maintain
            $anchor = '';
            $has_src = !empty($data['attributes']['src']);
            if ($has_src && mb_substr($data['attributes']['src'], 0, 1) == '#') {
                $anchor = $data['attributes']['src'];
            }

            // Only set asset, if no src or only anchor
            if (!$has_src || !empty($anchor)) {
                $data['attributes']['src'] = sqfAsset($this->asset, !$this->absolute, !$this->cache, !$this->notSecure) . $anchor;
            }
        }

        // Resolve media references
        if (!empty($data['attributes']['media'])) {
            $data['attributes']['media'] = SqfUi::resolveMediaReference($data['attributes']['media']);
        }
    }
}
