<?php

namespace SquirrelForge\Laravel\Ui\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use function App\View\Components\Ui\old;
use function App\View\Components\Ui\session;

class Input extends UiComponent
{
    // TODO: add "bind" method/attribute to automatically bind to old/input/model value!?
    protected static array $noValueAttributeTypes = ['select', 'textarea', 'password'];
    protected static array $attributesFilter = [];
    public ?string $label = null;
    public bool $labelAfter = false;
    public ?array $errorMessages;
    public ?array $dataList;
    public $bind = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $label = null,
        bool $labelAfter = false,
        ?array $errorMessages = null,
        ?array $dataList = null,
        $bind = null,
    ) {
        $this->setProperties([
            'label' => $label,
            'labelAfter' => $labelAfter,
            'bind' => $bind,
            'errorMessages' => $errorMessages,
            'dataList' => $dataList,
        ]);
        parent::__construct();
    }

    protected function inputBind($value): null|bool|Model
    {
        if (empty($value)) return null;
        if ($value instanceof Model) return $value;
        if (in_array($value, [true, 1, '1', 'true'])) return true;
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
                if (empty($data['errorMessages'])) {
                    $data['errorMessages'] = $this->getFieldErrors($name);
                }
                if (empty($data['attributes']['value']) && !in_array($data['attributes']['type'], static::$noValueAttributeTypes)) {
                    if ($this->bind === true) {
                        $data['attributes']['value'] = old($name) ?? '';
                    } else {
                        $data['attributes']['value'] = old($name) ?? $this->bind->{$name};
                    }
                }
            }
            /*
            if (!in_array($data['attributes']['type'], static::$noValueAttributeTypes)) {
                if (empty($data['attributes']['value'])) {
                    $data['attributes']['value'] = $this->value ?? old($name);
                }
            }
            if ($data['attributes']['type'] === 'checkbox') {
                $data['attributes']['checked'] = (bool)($this->value ?? old($name));
                if ($this->attrValue) $data['attributes']['value'] = $this->attrValue;
            }
            */
            if (!empty($this->dataList) && empty($data['attributes']['list'])) {
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
    protected function getFieldErrors(string $name): ?array
    {
        $errors = session()->get('errors');
        if (!empty($errors) && $errors->has($name)) {
            return $errors->get($name);
        }
        return null;
    }
}
