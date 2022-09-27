# Model Attributes

<!-- BADGES_START -->
<!-- [![Latest Version][badge-release]][packagist]
[![PHP Version][badge-php]][php]
[![Tests][badge-tests]][tests]
[![Total Downloads][badge-downloads]][downloads]

[badge-tests]: https://github.com/juststeveking/laravel-data-object-tools/actions/workflows/test.yml/badge.svg
[badge-release]: https://img.shields.io/packagist/v/juststeveking/laravel-data-object-tools.svg?style=flat-square&label=release
[badge-php]: https://img.shields.io/packagist/php-v/juststeveking/laravel-data-object-tools.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/juststeveking/laravel-data-object-tools.svg?style=flat-square&colorB=mediumvioletred

[packagist]: https://packagist.org/packages/juststeveking/laravel-data-object-tools
[php]: https://php.net
[downloads]: https://packagist.org/packages/juststeveking/laravel-data-object-tools
[tests]: https://github.com/juststeveking/laravel-data-object-tools/actions/workflows/test.yml -->
<!-- BADGES_END -->

A small package that aims to give you a better DX when working with Laravel Eloquent Models.

```php
<?php 

#[ModelAttributes(
    attributes: [
        'id' => ['primary' => 'uuid'],
        'name' => ['fill'],
        'email' => ['fill'],
        'password' => ['hidden', 'fill'],
        'remember_token' => ['hidden'],
        'email_verified_at' => ['cast' => 'datetime', 'value' => null],
        'create_at' => ['cast' => 'datetime'],
        'updated_at'=> ['cast' => 'datetime'],
    ]
)]
class User extends Model
{
    use  HasModelAttributes;
}

```

## Installation

This package requires PHP 8.1 as it takes advantage of `readonly` properties internally. 

```bash
composer require joecianflone/model-attributes
```

## Usage

Using ModelAttributes is as simple as adding the `ModelAttributes` attribute to your model class:

```php
#[ModelAttributes(
    attributes: [
        'id' => ['primary' => 'uuid'],
        'name' => ['fill'],
        'email' => ['fill'],
        'status' => ['cast' => ActiveState::class, 'value' => ActiveState::ACTIVE],
        'password' => ['hidden', 'fill'],
        'remember_token' => ['hidden'],
        'email_verified_at' => ['cast' => 'datetime', 'value' => null],
        'create_at' => ['cast' => 'datetime'],
        'updated_at'=> ['cast' => 'datetime'],
    ]
)]
```

...and adding the `HasModelAttributes` trait. 


## Testing

To run the test suite:

```bash
composer run test
```

## Credits

- [Joe Cianflone](https://github.com/JoeCianflone)

## LICENSE

The MIT License (MIT). Please see [License File](./LICENSE) for more information.

