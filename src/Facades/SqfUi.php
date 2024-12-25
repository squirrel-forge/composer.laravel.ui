<?php

namespace SquirrelForge\Laravel\Ui\Facades;

use Illuminate\Support\Facades\Facade;
use SquirrelForge\Laravel\Ui\Service;

/**
 * Class SqfUi
 *
 * @method static string metaTags() Get the page meta tags
 * @method static string bodyAttributes() Get body attributes bag
 */
class SqfUi extends Facade {

    protected static function getFacadeAccessor() { return Service::class; }

}
