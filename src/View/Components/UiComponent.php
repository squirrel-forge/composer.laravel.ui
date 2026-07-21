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
    /** @var array $boolFalseValues Values that match an explicit false. */
    public static array $boolFalseValues = [0, false, 'false', 'off', 'no'];

    /** @var array $boolTrueValues Values that match an explicit true. */
    public static array $boolTrueValues = [1, true, 'true', 'on', 'yes'];

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

    /** @var array|string[] $mediaReferences List of media attribute values by name. */
    public static array $mediaReferences = [
        'mobile' => '(max-width: 767px)',
        'tablet' => '(min-width: 768px) and (max-width: 1024px)',
        'desktop' => '(min-width: 1025px)',
    ];

    /**
     * Resolve media reference name
     * @param string $name
     * @return string
     * @throws UnknownMediaReferenceException
     */
    public static function resolveMediaReference(string $name): string
    {
        if (isset(static::$mediaReferences[$name])) return static::$mediaReferences[$name];
        return $name;
    }

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
        $this->setProperties($attributes);
        foreach ($attributes as $name => $value) {
            $data['attributes'][$name] = $value;
        }
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
