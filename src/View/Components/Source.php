<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui Source
 */
class Source extends UiComponent
{
    /** @var string $asset Generates src for given asset. */
    public string $asset;

    /** @var bool $relative Relative asset path. */
    public bool $relative;

    /** @var bool $cache Append cache breaker to asset. */
    public bool $cache;

    /** @var bool $secure Use https if not relative. */
    public bool $secure;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $asset = '',
        bool $relative = false,
        bool $cache = false,
        bool $secure = false,
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'asset' => $asset,
            'relative' => $relative,
            'cache' => $cache,
            'secure' => $secure,
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
                $data['attributes']['src'] = sqfAsset($this->asset, $this->relative, $this->cache, $this->secure) . $anchor;
            }
        }

        // Resolve media references
        if (!empty($data['attributes']['media'])) {
            $data['attributes']['media'] = static::resolveMediaReference($data['attributes']['media']);
        }
    }
}
