<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component as ViewComponent;
use SquirrelForge\Laravel\Ui\Exceptions\UnknownMediaReferenceException;

/**
 * Ui Component
 * Helpers and Abstracts
 */
abstract class UiComponent extends ViewComponent
{
    /** @var array $arbitrary Arbitrary properties set at runtime. */
    public array $arbitrary;

    /**
     * Set arbitrary attributes for component
     * @param array $data
     * @param array $attributes
     * @return void
     */
    protected function setArbitraryAttributes(array &$data, array $attributes): void
    {
        foreach ($attributes as $name => $value) {
            if (property_exists($this, $name)) continue;
            $data['attributes'][$name] = $value;
        }
        $this->setProperties($attributes);
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
                $this->{$name} = $this->{$method}($value);
            } else {
                $this->{$name} = $value;
            }
        }
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
            return view('sqf-ui::' . $name, $data);
        };
    }
}
