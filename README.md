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

**Now supports readonly, placeholder and overriding the default `type="url"` if you prefer not to have the validation in the browser. This is from the standard Nova `Text` field so is not documented here.**

It is recommended that you include the standard `url` and/or `active_url` validation rules, as they are not automatically added.

### Options
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

#### Clickable
Make the field display as a link on the detail page:

```php
Url::make('Homepage')
    ->clickable(),
```

#### Clickable on Index
Make the field display as a link on the index page:

```php
Url::make('Homepage')
    ->clickableOnIndex(),
```

#### Always Clickable
Combination of the two functions above for simplicity:

```php
Url::make('Homepage')
    ->alwaysClickable(),
```

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
