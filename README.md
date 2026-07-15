# composer.laravel.ui

## Squirrel-Forge Laravel Ui Abstracts and Components

### Table of Contents

 - [View Components](#view-components)
 - [Document template](#document-template)
 - [Debugger](#debugger)

## Module information

Composer module: **squirrel-forge/lara-ui**

Composer repository entry:
```json
{
    "type": "vcs",
    "url": "git@github.com:squirrel-forge/composer.laravel.ui.git",
    "no-api": true
}
```

## View Components

### Form
### Fieldset
### Button
### Input
### Modal

## Document template

### Render structure

 - head
   - @section page_first
   - Generated meta data.
   - @section page_meta
   - @stack styles
   - @section page_head
 - body
   - @section page_before
   - @section page_content
   - @section page_after
   - @section page_end
   - @stack scripts
   - @section page_final

### Adding tags to the head

Set meta tags via the facade as following:

```php
SqfUi::meta([
    [
        '_tag' => 'title',
        '_html' => 'Page title',
    ],
    [
        'name' => 'description',
        'content' => 'Page description.',
    ],
    [
        '_tag' => 'link',
        'rel'  => 'shortcut icon',
        'href' => '/favicon.ico',
        'type' => 'image/vnd.microsoft.icon',
    ],
]);
```

### Adding attributes to the body

Add classes or attributes to the page body as following:

```php
SqfUi::body([
    'class' => 'page-body',
    'data-attribute' => 'value',
]);
```

### Dynamic named attributes

If needed, utilize the named attributes helper to allow for customizable attribute bags:

```php
SqfUi::attributes('named-element', [
    'class' => 'element-class',
    'data-attribute' => 'value',
]);
```

```bladehtml
<div {!! SqfUi::attributes('named-element', ['class' => 'extend-class']) !!}>
```

## Debugger
