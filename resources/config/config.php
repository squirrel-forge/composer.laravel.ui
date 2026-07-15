<?php

/**
 * Squirrel-Forge Laravel Ui Abstracts and Components Configuration.
 */
return [
    'meta' => [

        /**
         * Global meta tags, always used when rendering a document.
         */
        'global' => [
            ['http-equiv' => 'content-type', 'content' => 'text/html; charset=UTF-8'],
            ['charset' => 'utf-8'],
            ['content' => 'IE=edge,chrome=1', 'http-equiv' => 'X-UA-Compatible'],
            ['content' => 'width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=5.0', 'name' => 'viewport'],
        ],

        /**
         * Route names to exclude from canonical link generation.
         */
        'excludeCanonicalRoutes' => ['laravel-folio'],
    ],
];
