<?php

namespace SquirrelForge\Laravel\Ui;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\Foundation\Application as LaravelApplication;
use const SquirrelForge\Laravel\CoreSupport\VERSION as CoreSupportVERSION;

/**
 * Ui Service
 */
class Service {

    /** @type string Package version. */
    const string VERSION = '0.8.0';

    /**
     * @var array $versions Collection of software versions
     */
    protected array $versions = [];

    /**
     * Get version defaults
     * @return array
     */
    protected function getVersionDefaults(): array
    {
        return [
            'sqf-ui' => static::VERSION,
            'sqf-cs' => CoreSupportVERSION,
            'Laravel' => LaravelApplication::VERSION,
            'PHP' => PHP_VERSION,
        ];
    }

    /**
     * Get version information
     * @return array
     */
    public function getVersions(): array
    {
        $defaults = $this->getVersionDefaults();
        return array_merge($this->versions, $defaults);
    }

    /**
     * Set a version reference
     * @param string $name
     * @param string $version
     * @return void
     */
    public function setVersion(string $name, string $version): void
    {
        $this->versions[$name] = $version;
    }

    /** @var string|null $canonical Runtime custom canonical url. */
    protected ?string $canonical = null;

    /** @var array|string[] $removeCanonicalParams Url parameters to remove for canonical links. */
    protected array $removeCanonicalParams = ['fallbackPlaceholder'];

    /** @var array|string[] $noSlashTags Tags that should not have a closing slash when used as a single tag. */
    protected array $noSlashTags = ['meta', 'link'];

    /** @var array $metaData Runtime metadata to be used. */
    protected array $metaData = [];

    /** @var ComponentAttributeBag $bodyAttributes Runtime body attributes to be used. */
    protected ComponentAttributeBag $bodyAttributes;

    /** @var ComponentAttributeBag[] $attributeBags Runtime dynamic attributes to be used. */
    protected array $attributeBags = [];

    /** @var array $boolFalseValues Values that match an explicit false. */
    public array $boolFalseValues = [0, false, 'false', 'off', 'no'];

    /** @var array $boolTrueValues Values that match an explicit true. */
    public array $boolTrueValues = [1, true, 'true', 'on', 'yes'];

    /** @var array|string[] $mediaReferences List of media attribute values by name. */
    public array $mediaReferences = [
        'mobile-mini' => '(max-width: 320px)',
        'mobile-small' => '(max-width: 374px)',
        'mobile-classic' => '(max-width: 480px)',
        'mobile-medium' => '(max-width: 560px)',
        'mobile-large' => '(max-width: 640px)',
        'mobile' => '(max-width: 767px)',
        'mobile-tablet-portrait' => '(max-width: 991px)',
        'mobile-tablet' => '(max-width: 1024px)',
        'tablet' => '(min-width: 768px) and (max-width: 1024px)',
        'tablet-portrait' => '(min-width: 768px) and (max-width: 991px)',
        'tablet-landscape' => '(min-width: 992px) and (max-width: 1024px)',
        'tablet-desktop' => '(min-width: 768px)',
        'tablet-landscape-desktop' => '(min-width: 992px)',
        'desktop' => '(min-width: 1025px)',
        'desktop-nano' => '(min-width: 1152px)',
        'desktop-mini' => '(min-width: 1200px)',
        'desktop-small' => '(min-width: 1366px)',
        'desktop-medium' => '(min-width: 1440px)',
        'desktop-classic' => '(min-width: 1600px)',
        'desktop-large' => '(min-width: 1920px)',
    ];

    /**
     * Construct the service.
     */
    public function __construct()
    {
        $this->bodyAttributes = new ComponentAttributeBag([]);
    }

    /**
     * Get merged falsy values
     * @param array $with
     * @return array
     */
    public function boolFalsy(array $with = []): array
    {
        return array_merge([], $this->boolFalseValues, $with);
    }

    /**
     * Get merged truthy values
     * @param array $with
     * @return array
     */
    public function boolTruthy(array $with = []): array
    {
        return array_merge([], $this->boolTrueValues, $with);
    }

    /**
     * Value is falsy
     * @param mixed $value
     * @param array $falsyToo
     * @return bool
     */
    public function isFalsy(mixed $value, array $falsyToo = []): bool
    {
        if (isset($value) && is_string($value)) $value = mb_strtolower(trim($value));
        if (empty($value)) return true;
        if (in_array($value, $this->boolFalsy($falsyToo), true)) return true;
        return false;
    }

    /**
     * Value is truthy
     * @param mixed $value
     * @param array $truthyToo
     * @return bool
     */
    public function isTruthy(mixed $value, array $truthyToo = []): bool
    {
        if (isset($value) && is_string($value)) $value = mb_strtolower(trim($value));
        if (in_array($value, $this->boolTruthy($truthyToo), true)) return true;
        return false;
    }

    /**
     * Resolve media reference name
     * @param string $name
     * @return string
     */
    public function resolveMediaReference(string $name): string
    {
        if (isset($this->mediaReferences[$name])) return $this->mediaReferences[$name];
        return $name;
    }

    /**
     * Set/remove runtime canonical url.
     * @param null|string $url
     * @return void
     */
    public function canonical(?string $url = null): void
    {
        $this->canonical = $url;
    }

    /**
     * Set/remove runtime canonical url.
     * @param null|array|string[] $params
     * @param bool $replace
     * @return void
     */
    public function removeCanonicalParams(?array $params = null, bool $replace = false): void
    {
        if ($replace) $this->removeCanonicalParams = [];
        $this->removeCanonicalParams = array_merge($this->removeCanonicalParams, $params ?? []);
    }

    /**
     * Set runtime meta tags.
     * @param null|array $data
     * @param bool|callable $replace
     * @return void
     */
    public function meta(?array $data = null, bool|callable $replace = false): void
    {
        if (is_bool($replace) && $replace) $this->metaData = [];
        if (is_callable($replace)) {
            $append = [];
            foreach ($data as $new_entry) {
                $did_replace = false;
                foreach ($this->metaData as $key => $old_entry) {
                    if (call_user_func_array($replace, [$old_entry, $new_entry])) {
                        $this->metaData[$key] = $new_entry;
                        $did_replace = true;
                        break;
                    }
                }
                if (!$did_replace) $append[] = $new_entry;
            }
            if (!empty($append)) $this->metaData = array_merge($this->metaData, $append);
        } else {
            $this->metaData = array_merge($this->metaData, $data ?? []);
        }
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
            $rendered[] = $this->renderTag('meta', $attributes);
        }
        return implode("\n", $rendered);
    }

    /**
     * Render tag.
     * @param string $tag
     * @param array<string, string> $attributes
     * @return string
     */
    public function renderTag(string $tag, array $attributes): string
    {
        $tag = $attributes['_tag'] ?? $tag;
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
        $defaultClass = config('sqf-ui.body.defaultClass', '');
        $routeClassPrefix = config('sqf-ui.body.routeClassPrefix', '');
        $attributes = [];
        if (!empty($defaultClass)) {
            $attributes['class'] = $defaultClass . ' ' . $routeClassPrefix . $routeName;
        }
        $attributes['data-route'] = $routeName;
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
            foreach ($this->removeCanonicalParams as $param) {
                if (isset($params[$param])) unset($params[$param]);
            }
            $url = route($current, $params);
        }
        return $url;
    }
}
