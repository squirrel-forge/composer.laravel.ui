<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui Button
 */
class Button extends UiComponent
{
    /** @var string $label Button label text. */
    public string $label;

    /** @var string $route Generates href for given route. */
    public string $route;

    /** @var array $params Route params. */
    public array $params;

    /** @var bool $absolute Absolute route href. */
    public bool $absolute;

    /** @var string $iconBefore Add icon before label. */
    public string $iconBefore;

    /** @var string $iconBeforeClasses Add classes to before icon. */
    public string $iconBeforeClasses;

    /** @var string $iconAfter Add icon after label. */
    public string $iconAfter;

    /** @var string $iconAfterClasses Add classes to after icon. */
    public string $iconAfterClasses;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $label = '',
        string $route = '',
        array $params = [],
        bool $absolute = false,
        string $iconBefore = '',
        string $iconBeforeClasses = '',
        string $iconAfter = '',
        string $iconAfterClasses = '',
    ) {
        $this->setProperties([
            'label' => $label,
            'route' => $route,
            'params' => $params,
            'absolute' => $absolute,
            'iconBefore' => $iconBefore,
            'iconBeforeClasses' => $iconBeforeClasses,
            'iconAfter' => $iconAfter,
            'iconAfterClasses' => $iconAfterClasses,
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
        // If route is defined
        if (!empty($this->route)) {

            // Check for anchor to maintain
            $anchor = '';
            $has_href = !empty($data['attributes']['href']);
            if ($has_href && mb_substr($data['attributes']['href'], 0, 1) == '#') {
                $anchor = $data['attributes']['href'];
            }

            // Only set route, if no href or only anchor
            if (!$has_href || !empty($anchor)) {
                $data['attributes']['href'] = route($this->route, $this->params, $this->absolute) . $anchor;
            }
        }
    }
}
