<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

use SquirrelForge\Laravel\Ui\Facades\SqfUi;

/**
 * Ui Picture
 */
class Video extends UiComponent
{
    /** @var array $sources All video sources. */
    public array $sources;

    /** @var bool $process Process video sources */
    public bool $process;

    /** @var string $localPath Process local path */
    public string $localPath;

    public bool $noNative;

    public int $selected;

    public bool $noControls;

    public string $preload;

    public bool $notPlaysinline;

    /**
     * Create a new component instance.
     */
    public function __construct(
        array $sources = [],
        bool $process = false,
        string $localPath = '',
        int $selected = 0,
        bool $noNative = false,
        bool $noControls = false,
        string $preload = 'auto',
        bool $notPlaysinline = false,
        array $arbitrary = [],
    ) {
        $this->setProperties([
            'sources' => $sources,
            'process' => $process,
            'localPath' => $localPath,
            'selected' => $selected,
            'noNative' => $noNative,
            'noControls' => $noControls,
            'preload' => $preload,
            'notPlaysinline' => $notPlaysinline,
            'arbitrary' => $arbitrary,
        ]);
    }

    /**
     * Process video sources
     * @param array $sources
     * @param array $props
     * @return null|array
     */
    protected function inputSources(array $sources, array $props): ?array
    {
        // Sources should be processed
        if (isset($props['process']) && SqfUi::isTruthy($props['process'] ?? false)) {
            return SqfUi::processVideoSources($sources, empty($props['localPath']) ? null : $props['localPath']);
        }
        return $sources;
    }
}
