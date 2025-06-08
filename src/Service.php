<?php

namespace SquirrelForge\Laravel\Ui;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;

/**
 * Ui Service
 */
class Service {

    /** @type string Package version. */
    const VERSION = '0.5.2';

    /** @var string|null $canonical Runtime custom canonical url. */
    protected ?string $canonical = null;

    /** @var array|string[] $noSlashTags Tags that should not have a closing slash when used as a single tag. */
    protected array $noSlashTags = ['meta', 'link'];

    /** @var array $metaData Runtime meta data to be used. */
    protected array $metaData = [];

    /** @var ComponentAttributeBag $bodyAttributes Runtime body attributes to be used. */
    protected ComponentAttributeBag $bodyAttributes;

    /** @var ComponentAttributeBag[] $attributeBags Runtime dynamic attributes to be used. */
    protected array $attributeBags = [];

    /**
     * Construct the service.
     */
    public function __construct()
    {
        $this->bodyAttributes = new ComponentAttributeBag([]);
    }

    /**
     * Set/remove runtime canonical url.
     * @param null|string $url
     * @return void
     */
    public function canonical(string $url = null): void
    {
        $this->canonical = $url;
    }

    /**
     * Set runtime meta tags.
     * @param array $data
     * @param bool $replace
     * @return void
     */
    public function meta(array $data, bool $replace = false): void
    {
        if ($replace) $this->metaData = [];
        $this->metaData = array_merge($this->metaData, $data);
    }

    /**
     * Set runtime body attributes
     * @param array $attributes
     * @param bool $replace
     * @return void
     */
    public function body(array $attributes, bool $replace = false): void
    {
        if ($replace) {
            $this->bodyAttributes = new ComponentAttributeBag($attributes);
        } else {
            $this->bodyAttributes = $this->bodyAttributes->merge($attributes);
        }
    }

    /**
     * Set/get runtime named attributes
     * @param string $name
     * @param array $attributes
     * @param bool $replace
     * @return ComponentAttributeBag
     */
    public function attributes(string $name, array $attributes, bool $replace = false): ComponentAttributeBag
    {
        if ($replace || !isset($this->attributeBags[$name])) {
            $this->attributeBags[$name] = new ComponentAttributeBag($attributes);
        } else {
            $this->attributeBags[$name] = $this->attributeBags[$name]->merge($attributes);
        }
        return $this->attributeBags[$name];
    }

    /**
     * Get page meta tags.
     * @return string
     */
    public function metaTags(): string
    {
        $rendered = [];

        // Use global and runtime meta data
        $data = array_merge(config('sqf-ui.meta.global', []), $this->metaData);

        // Add canonical link if available
        $canonical = $this->getCanonicalUrl();
        if ($canonical) $data[] = ['_tag' => 'link', 'rel' => 'canonical', 'href' => $canonical];

        // End empty
        if (empty($data)) return '';

        // Render and return all tags
        foreach ($data as $attributes) {
            $rendered[] = $this->renderTag($attributes);
        }
        return implode('', $rendered);
    }

    /**
     * Render tag.
     * @param array<string, string> $attributes
     * @return string
     */
    public function renderTag(array $attributes): string
    {
        $tag = $attributes['_tag'] ?? 'meta';
        $html = $attributes['_html'] ?? '';
        $text = $attributes['_text'] ?? '';
        if (!empty($text)) $html = htmlspecialchars($text);
        unset($attributes['_tag']);
        unset($attributes['_html']);
        unset($attributes['_text']);
        $slash = !in_array($tag, $this->noSlashTags);
        $attributes = new ComponentAttributeBag($attributes);
        return '<' . $tag . ($attributes->isEmpty() ? '' : ' ') . $attributes . (empty($html) && $slash ? '/' : '') . '>' .
            $html . (!empty($html) ? '</' . $tag . '>' : '');
    }

    /**
     * Get body attributes.
     * @return ComponentAttributeBag
     */
    public function bodyAttributes(): ComponentAttributeBag
    {
        $realRouteName = Route::currentRouteName();
        $routeName = 'undefined';
        if (!empty($realRouteName)) {
            $routeName = Str::slug(preg_replace('/[.:]+/', '-', $realRouteName),'-');
        }
        $attributes = [
            'class' => 'ui-page ' . $routeName,
            'data-route' => $routeName,
        ];
        return $this->bodyAttributes->merge($attributes);
    }

    /**
     * Get canonical url.
     * @return string|null
     */
    public function getCanonicalUrl(): ?string {
        $url = null;
        $current = Route::currentRouteName();
        if (isset($this->canonical) && is_string($this->canonical)) {
            $url = $this->canonical;
        } else if (!empty($current) && !in_array($current, config('sqf-ui.meta.excludeCanonicalRoutes', []))) {
            $params = Route::current()->parameters();
            if (isset($params['fallbackPlaceholder'])) unset($params['fallbackPlaceholder']);
            $url = route($current, $params);
        }
        return $url;
    }
}
