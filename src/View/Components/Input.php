<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Input extends UiComponent
{
    public null|bool|Model $bind;
    public string $label;
    public bool $labelAfter;
    public string $labelTag;
    public string $labelClasses;
    public string $wrapClasses;
    public array $errorMessages;
    public bool $noErrors;
    public array $dataList;
    public bool $forgetValue;
    public string $pseudoIcon;
    public string $iconClasses;
    protected static array $noValueAttributeTypes = ['select', 'checkbox', 'radio', 'password'];
    public static array $hasPseudo = ['select', 'checkbox', 'radio'];

    /**
     * Create a new component instance.
     */
    public function __construct(
        $bind = null,
        string $label = '',
        bool $labelAfter = false,
        string $labelTag = 'strong',
        string $labelClasses = '',
        string $wrapClasses = '',
        array $errorMessages = [],
        bool $noErrors = false,
        array $dataList = [],
        bool $forgetValue = false,
        string $pseudoIcon = '',
        string $iconClasses = '',
    ) {
        $this->setProperties([
            'bind' => $bind,
            'label' => $label,
            'labelAfter' => $labelAfter,
            'labelTag' => $labelTag,
            'labelClasses' => $labelClasses,
            'wrapClasses' => $wrapClasses,
            'errorMessages' => $errorMessages,
            'noErrors' => $noErrors,
            'dataList' => $dataList,
            'forgetValue' => $forgetValue,
            'pseudoIcon' => $pseudoIcon,
            'iconClasses' => $iconClasses,
        ]);
    }

    protected function inputBind($value): null|bool|Model
    {
        if (empty($value)) return null;
        if ($value instanceof Model) return $value;
        if (static::isTruthy($value, ['bind'])) return true;
        return false;
    }

    protected function extendViewData(array &$data, string $componentName): void
    {
        $name = $this->getFieldName($data);
        if (!empty($name)) {
            if (empty($data['attributes']['name'])) {
                $data['attributes']['name'] = $name;
            }
            if (empty($data['attributes']['type'])) {
                $data['attributes']['type'] = 'text';
            }
            if ($this->bind) {
                if (empty($data['attributes']['value']) && !in_array($data['attributes']['type'], static::$noValueAttributeTypes)) {
                    if ($this->bind === true) {
                        $data['attributes']['value'] = $this->forgetValue ? '' : old($name) ?? '';
                    } else {
                        $data['attributes']['value'] = $this->forgetValue ? $this->bind->{$name} : old($name) ?? $this->bind->{$name};
                    }
                }
                if (!$this->forgetValue && in_array($data['attributes']['type'], ['checkbox', 'radio'])) {
                    if ($this->bind === true) {
                        if (!empty($data['attributes']['value'])) {
                            if (old($name) === $data['attributes']['value']) {
                                $data['attributes']['checked'] = '';
                            }
                        } else if (static::isTruthy(old($name))) {
                            $data['attributes']['checked'] = '';
                        }
                    } else if (!empty($data['attributes']['value'])) {
                        if (old($name) ?? $this->bind->{$name} === $data['attributes']['value']) {
                            $data['attributes']['checked'] = '';
                        }
                    } else if (static::isTruthy(old($name) ?? $this->bind->{$name})) {
                        $data['attributes']['checked'] = '';
                    }
                }
                if (!$this->forgetValue && $data['attributes']['type'] === 'select' && !empty($this->dataList)) {
                    if ($this->bind === true) {
                        if (old($name) || isset($data['attributes']['value'])) $data['attributes']['value'] = old($name) ?? $data['attributes']['value'];
                    } else {
                        $data['attributes']['value'] = old($name) ?? $this->bind->{$name};
                    }
                }
            }
            if ($data['attributes']['type'] !== 'select' && !empty($this->dataList) && empty($data['attributes']['list'])) {
                $data['attributes']['list'] = $name . '-' . Str::uuid();
            }
        }
    }

    protected function getFieldName(array $data): ?string
    {
        if (isset($data['attributes'])) {
            return $data['attributes']['name'] ?? $data['attributes']['type'];
        }
        return null;
    }
    public static function getFieldErrors(string $name): ?array
    {
        $errors = session()->get('errors');
        if (!empty($errors) && $errors->has($name)) {
            return $errors->get($name);
        }
        return null;
    }
}
