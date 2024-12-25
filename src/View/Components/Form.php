<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui Form
 */
class Form extends UiComponent
{
    /** @var string $route Generates action for given route. */
    public string $route;

    /** @var array $params Route params. */
    public array $params;

    /** @var bool $absolute Absolute route href. */
    public bool $absolute;

    /** @var bool $files Set form encryption for file upload. */
    public bool $files;

    /** @var bool $noCsrf Do not add the default _token/csrf hidden field. */
    public bool $noCsrf;

    /** @var bool $noWrap Do not add the default form content wrapper. */
    public bool $noWrap;

    /** @var string $wrapTag Set inner wrapping tag type, default: div */
    public string $wrapTag;

    /** @var string $wrapClasses Set inner wrapping classes. */
    public string $wrapClasses;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $route = '',
        array $params = [],
        bool $absolute = false,
        bool $files = false,
        bool $noCsrf = false,
        bool $noWrap = false,
        string $wrapTag = 'div',
        string $wrapClasses = '',
    ) {
        $this->setProperties([
            'route' => $route,
            'params' => $params,
            'absolute' => $absolute,
            'files' => $files,
            'noCsrf' => $noCsrf,
            'noWrap' => $noWrap,
            'wrapTag' => $wrapTag,
            'wrapClasses' => $wrapClasses,
        ]);
        parent::__construct();
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
            $has_action = !empty($data['attributes']['action']);
            if ($has_action && mb_substr($data['attributes']['action'], 0, 1) == '#') {
                $anchor = $data['attributes']['action'];
            }

            // Only set route, if no action or only anchor
            if (!$has_action || !empty($anchor)) {
                $data['attributes']['action'] = route($this->route, $this->params, $this->absolute) . $anchor;
            }
        }
    }
}
