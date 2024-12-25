<?php

namespace SquirrelForge\Laravel\Ui;

/**
 * Ui Service
 */
class Service {

    /**
     * Get page meta tags
     * @return string
     */
    public function metaTags(): string
    {
        return '<meta>';
    }

    /**
     * Get body attributes
     * @return string
     */
    public function bodyAttributes(): string
    {
        return 'class="ui-page"';
    }
}
