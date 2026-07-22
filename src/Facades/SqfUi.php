<?php

namespace SquirrelForge\Laravel\Ui\Facades;

use Illuminate\Support\Facades\Facade;
use SquirrelForge\Laravel\Ui\Service;

/**
 * Class SqfUi
 *
 * @method static array getVersions() Get all defined versions.
 * @method static void setVersion(string $name, string $version) Set name to version in list.
 * @method static array boolFalsy(array $with = []) Get merged falsy values.
 * @method static array boolTruthy(array $with = []) Get merged truthy values.
 * @method static bool isFalsy(mixed $value, array $falsyToo = []) Value is falsy.
 * @method static bool isTruthy(mixed $value, array $truthyToo = []) Value is truthy.
 * @method static string resolveMediaReference(string $name) Resolve media reference name.
 * @method static void canonical(?string $url = null) Un/set runtime canonical url.
 * @method static void removeCanonicalParams(?array $params = null, bool $replace = false) Remove canonical params.
 * @method static void meta(array $data, bool $replace = false) Set runtime meta tag/s.
 * @method static string metaTags() Get the page meta tags.
 * @method static void body(array $data, bool $replace = false) Set runtime body attributes.
 * @method static \Illuminate\View\ComponentAttributeBag bodyAttributes() Get body attributes bag.
 * @method static \Illuminate\View\ComponentAttributeBag attributes(string $name, array $attributes, bool $replace = false) Set/get runtime named attributes
 * @method static null|string getCanonicalUrl() Get canonical url.
 * @method static string renderTag(array $attributes) Render tag.
 */
class SqfUi extends Facade {

    protected static function getFacadeAccessor() { return Service::class; }

}
