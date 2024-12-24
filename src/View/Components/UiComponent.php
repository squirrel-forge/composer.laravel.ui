<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component as ViewComponent;

abstract class UiComponent extends ViewComponent
{
    public static array $boolFalseValues = [0, false, 'false', 'off'];

    public static function boolFalsy(array $with = []): array
    {
        return array_merge([], static::$boolFalseValues, $with);
    }

    /**
     * Create a new component instance.
     */
    public function __construct() {
        //
    }

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
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $instance = $this;
        $name = str_replace('\\','.', mb_strtolower(explode('\\Ui\\', static::class)[1]));
        return function (array $data) use ($name, $instance) {
            Log::debug($this === $instance);
            if (method_exists($instance, 'extendViewData')) {
                $instance->extendViewData($data, $name);
            }
            Log::debug($data);
            return view('sqf-ui::components.ui.' . $name, $data);
        };
    }
}
