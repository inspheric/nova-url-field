# Laravel Nova URL Field
A URL input and link field for Laravel Nova

[![Latest Version on Packagist](https://img.shields.io/packagist/v/inspheric/nova-url-field.svg?style=flat-square)](https://packagist.org/packages/inspheric/nova-url-field)
[![Total Downloads](https://img.shields.io/packagist/dt/inspheric/nova-url-field.svg?style=flat-square)](https://packagist.org/packages/inspheric/nova-url-field)

## Installation

Install the package into a Laravel app that uses [Nova](https://nova.laravel.com) with Composer:

```bash
composer require inspheric/nova-url-field
```

## Usage

Add the field to your resource in the ```fields``` method:
```php
use Inspheric\Fields\Url;

Url::make('Homepage')
    ->rules('url', /* ... */),
```

The field extends the `Laravel\Nova\Fields\Text` field, so all the usual methods are available.

Supports readonly, placeholder and overriding the default `type="url"` if you prefer not to have the validation in the browser. This is from the standard Nova `Text` field so is not documented here.

It is recommended that you include the standard `url` and/or `active_url` validation rules, as they are not automatically added.

### Options

> ##### Terminology: label, title, value
> The terms "label", "title" and "value" are used to describe the following options. They should be understood within the generated HTML as follows:
>
> ```blade
> <a href="{{ $value }}" title="{{ $title }}">{{ $label }}</a>
> ```

#### Label
Make the field display with a label instead of the URL value itself on the detail or index pages:

```php
Url::make('Homepage')
    ->label('External Link'),
```

You can, of course use the Laravel `trans()` or `__()` functions to translate the label.

The label is only displayed if the link is clickable, otherwise the URL value is displayed.

#### Label Using
Make the field display with a label using a callback:

```php
Url::make('Homepage')
    ->labelUsing(function($value, $resource) {
        return $this->title;
    }),
```

The arguments `$value` and `$resource` are passed in the same way as the callback for `resolveUsing()`, but are optional.

#### HTML Label

If you would like to use custom HTML for the label, remember to also use the `asHtml()` option.

```php
Url::make('Homepage')
    ->label('<strong>External</strong> Link')
    ->asHtml(),
```

#### Domain Label
A shortcut method to display the domain part only of the URL (i.e. without `https?://www.`) as the label:

```php
Url::make('Homepage')
    ->domainLabel(),
```

For example, the label for the field value `https://www.example.com/path?query=value&another=true#fragment` would display simply as `example.com`.

This is resolved after the `displayUsing()` callback if you have one, so if you modify the display of the URL in some way, the modified value will be passed to this label.

#### Name Label
A shortcut method to display the name of the field as the label:

```php
Url::make('Homepage')
    ->nameLabel(),
```

The label would be displayed as `Homepage`.

#### Title

Set the link's title attribute, which will be displayed when the mouse hovers over it:

```php
Url::make('Homepage')
    ->title('Link title'),
```

You can, of course use the Laravel `trans()` or `__()` functions to translate the label. If no custom title is set, the full URL value will be used.

The title is only used if the link is clickable.

#### Title Using
Set the title using a callback:

```php
Url::make('Homepage')
    ->titleUsing(function($value, $resource) {
        return $this->title;
    }),
```

#### Clickable
Make the field display as a link on the detail page:

```php
Url::make('Homepage')
    ->clickable(bool $clickable = true),
```

#### Clickable on Index
Make the field display as a link on the index page:

```php
Url::make('Homepage')
    ->clickableOnIndex(bool $clickable = true),
```

#### Always Clickable
Combination of the two functions above for simplicity:

```php
Url::make('Homepage')
    ->alwaysClickable(bool $clickable = true),
```

#### Open in Same Tab
By default, the clickable link will open in a new tab (using `target="_blank"`). You can modify this behaviour so that the link opens in the same tab:

```php
Url::make('Homepage')
    ->sameTab(bool $sameTab = true),
```

#### `rel=noopener` and `rel=noreferrer`
By default, a clickable link will open in a new tab and will have the `rel=noopener` attribute set*. If you use `sameTab()` as above, `rel=noopener` will be unset.

To override the default behaviour, you can choose to set or unset `rel=noopener` and/or `rel=noreferrer` with the following methods:

```php
Url::make('Homepage')
    ->noopener(bool $noopener = true),

Url::make('Homepage')
    ->noreferrer(bool $noreferrer = true),
```

If you use both `sameTab()` and `noopener()` on the same field, ensure that `noopener()` comes _after_ `sameTab()` or the two settings will cancel each other out.

\* See [this article](https://mathiasbynens.github.io/rel-noopener/) for an explanation.

#### Custom HTML

If you do not wish the link to be displayed with the default icon and text, you can set custom HTML which will replace the entire contents of the default template:

```php
Url::make('Homepage')
    ->customHtml('<span class="my-class">Click here!</span>'),
```

If the link is clickable, this content will be wrapped in an unstyled `<a>` tag which implements all of the other options you have specified, such as `sameTab`, `title` etc.

If you _do_ want the link to appear as link-styled text, you can add the classes `dim text-primary` within the HTML you specify.

**Important!** It is **your** responsibility to escape or sanitize any user-provided data before displaying it as raw HTML. This package does not do that for you.

#### Custom HTML Using
Set the custom HTML using a callback:

```php
Url::make('Homepage')
    ->customHtmlUsing(function($value, $resource, $label) {
        return view('partials.link_text', [
            'url'   => $value,
            'label' => $label,
        ])->render();
    }),
```

Note that the callback has a third argument `$label`, which will contain the appropriate label based on which of the `label()`, `labelUsing()`, `nameLabel()`, `domainLabel()` etc. options you have set on the field.

Remember that if the link is clickable, the custom HTML you specify is already wrapped in an `<a href="">` tag, so you should not include an `<a>` tag in your own custom HTML.

## Appearance
### Index (default)
![index-field](https://raw.githubusercontent.com/inspheric/nova-url-field/master/docs/index-field.png)

The field is displayed as a plain `<span>` element.

### Index (clickable)
![index-field-clickable](https://raw.githubusercontent.com/inspheric/nova-url-field/master/docs/index-field-clickable.png)

The field is displayed as an `<a href="...">` element with an icon.

### Index (clickable with label)
![index-field-clickable-label](https://raw.githubusercontent.com/inspheric/nova-url-field/master/docs/index-field-clickable-label.png)

The field is displayed as an `<a href="...">` element with an icon and a custom label.

### Detail (default)
![detail-field](https://raw.githubusercontent.com/inspheric/nova-url-field/master/docs/detail-field-plain.png)

The field is displayed as a plain `<span>` element.

### Detail (clickable)
![detail-field-clickable](https://raw.githubusercontent.com/inspheric/nova-url-field/master/docs/detail-field-clickable.png)

The field is displayed as an `<a href="...">` element with an icon.

### Detail (clickable with label)
![detail-field-clickable-label](https://raw.githubusercontent.com/inspheric/nova-url-field/master/docs/detail-field-clickable-label.png)

The field is displayed as an `<a href="...">` element with an icon and a custom label.

### Form
![form-field](https://raw.githubusercontent.com/inspheric/nova-url-field/master/docs/form-field.png)

The field is displayed as an `<input type="url">` element.

## Donate

:purple_heart: If you like this package, you can show your appreciation by [donating any amount via PayPal](https://burtonsenior.com/donate/inspheric/nova-url-field) to support ongoing development.
