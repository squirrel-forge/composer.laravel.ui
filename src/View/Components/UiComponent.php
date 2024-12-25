<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component as ViewComponent;

/**
 * Ui Component
 * Helpers and Abstracts
 */
abstract class UiComponent extends ViewComponent
{
    /** @var array $boolFalseValues Values that match an explicit false. */
    public static array $boolFalseValues = [0, false, 'false', 'off'];

    /** @var array $boolTrueValues Values that match an explicit true. */
    public static array $boolTrueValues = [1, true, 'true', 'on'];

    /**
     * Get merged falsy values
     * @param array $with
     * @return array
     */
    public static function boolFalsy(array $with = []): array
    {
        return array_merge([], static::$boolFalseValues, $with);
    }

    /**
     * Get merged truthy values
     * @param array $with
     * @return array
     */
    public static function boolTruthy(array $with = []): array
    {
        return array_merge([], static::$boolTrueValues, $with);
    }

    /**
     * Value is falsy
     * @param mixed $value
     * @param array $falsyToo
     * @return bool
     */
    public static function isFalsy(mixed $value, array $falsyToo = []): bool
    {
        if (isset($value) && is_string($value)) $value = mb_strtolower(trim($value));
        if (empty($value)) return true;
        if (in_array($value, static::boolFalsy($falsyToo), true)) return true;
        return false;
    }

    /**
     * Value is truthy
     * @param mixed $value
     * @param array $truthyToo
     * @return bool
     */
    public static function isTruthy(mixed $value, array $truthyToo = []): bool
    {
        if (isset($value) && is_string($value)) $value = mb_strtolower(trim($value));
        if (in_array($value, static::boolTruthy($truthyToo), true)) return true;
        return false;
    }

    /**
     * Create a new component instance.
     */
    public function __construct() {
        //
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
     * Get the view / contents that represent the component.
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        $name = str_replace('\\','.', mb_strtolower(explode('\\View\\', static::class)[1]));
        return function (array $data) use ($name) {
            if (method_exists($this, 'extendViewData')) {
                $this->extendViewData($data, $name);
            }
            return view('sqf-ui::' . $name, $data);
        };
    }
}
