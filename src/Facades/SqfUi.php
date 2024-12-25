<?php

namespace SquirrelForge\Laravel\Ui\Facades;

use Illuminate\Support\Facades\Facade;
use SquirrelForge\Laravel\Ui\Service;

/**
 * Class SqfUi
 *
 * @method static void canonical(string $url) Set runtime canonical url.
 * @method static void meta(array $data, bool $replace = false) Set runtime meta tag/s.
 * @method static string metaTags() Get the page meta tags.
 * @method static void body(array $data, bool $replace = false) Set runtime body attributes.
 * @method static \Illuminate\View\ComponentAttributeBag bodyAttributes() Get body attributes bag.
 * @method static null|string getCanonicalUrl() Get canonical url.
 * @method static string renderTag(array $attributes) Render tag.
 */
class SqfUi extends Facade {

    protected static function getFacadeAccessor() { return Service::class; }

}
