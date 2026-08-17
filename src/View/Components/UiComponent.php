<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component as ViewComponent;

/**
 * Ui Component
 * Helpers and Abstracts
 */
abstract class UiComponent extends ViewComponent
{
    /** @var array $arbitrary Arbitrary properties set at runtime. */
    public array $arbitrary;

    /** @var string $viewPrefix Default view prefix. */
    protected string $viewPrefix = 'sqf-ui::';

    /**
     * Get
     * list of defined class properties
     * @return array
     */
    protected function getClassVars(): array
    {
        return array_keys(get_class_vars(static::class));
    }

    /**
     * Set arbitrary attributes for component
     * @param array $data
     * @param array $attributes
     * @return void
     */
    protected function setArbitraryAttributes(array &$data, array $attributes): void
    {
        foreach ($attributes as $name => $value) {
            if (in_array($name, $this->getClassVars())) continue;
            $data['attributes'][$name] = $value;
        }
    }

    /**
     * Set component arbitrary properties
     * @param array $props
     * @return void
     */
    protected function setArbitraryProperties(array $props): void
    {
        if (empty($props['arbitrary'])) return;
        $this->setProperties($props['arbitrary']);
    }

    /**
     * Set component properties
     * @param array $props
     * @return void
     */
    protected function setProperties(array $props): void
    {
        foreach ($props as $name => $value) {
            $method = 'input' . ucfirst($name);
            if (method_exists($this, $method)) {
                $this->{$name} = $this->{$method}($value, $props);
            } else {
                $this->{$name} = $value;
            }
        }
        $this->setArbitraryProperties($props);
    }

    /**
     * Get the view / contents that represents the component.
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        $name = str_replace('\\','.', mb_strtolower(explode('\\View\\', static::class)[1]));
        return function (array $data) use ($name) {
            if (!empty($this->arbitrary)) $this->setArbitraryAttributes($data, $this->arbitrary);
            if (method_exists($this, 'extendViewData')) $this->extendViewData($data, $name);
            return view($this->viewPrefix . $name, $data);
        };
    }
}
