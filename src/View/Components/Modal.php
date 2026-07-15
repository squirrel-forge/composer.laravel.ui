<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

/**
 * Ui Modal
 */
class Modal extends UiComponent
{
    /** @var string $mode Modal mode. */
    public string $mode;

    /** @var bool $outerScroll Set content scroll to container instead of content. */
    public bool $outerScroll;

    /** @var string $title Modal header title. */
    public string $title;

    /** @var string $template Content template name. */
    public string $template;

    /** @var array $vars Content template variables. */
    public array $vars;

    /** @var bool $noHeader Do not add header container. */
    public bool $noHeader;

    /** @var bool $noHeaderControls Do not add header controls. */
    public bool $noHeaderControls;

    /** @var bool $noFooter Do not add footer container. */
    public bool $noFooter;

    /** @var bool $noFooterControls Do not add footer controls. */
    public bool $noFooterControls;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $mode = '',
        string $title = '',
        string $template = '',
        array $vars = [],
        bool $outerScroll = false,
        bool $noHeader = false,
        bool $noHeaderControls = false,
        bool $noFooter = false,
        bool $noFooterControls = false
    ) {
        $this->setProperties([
            'mode' => $mode,
            'title' => $title,
            'template' => $template,
            'vars' => $vars,
            'outerScroll' => $outerScroll,
            'noHeader' => $noHeader,
            'noHeaderControls' => $noHeaderControls,
            'noFooter' => $noFooter,
            'noFooterControls' => $noFooterControls,
        ]);
    }
}
