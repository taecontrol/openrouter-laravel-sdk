# An OpenRouter SDK for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/taecontrol/openrouter-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/taecontrol/openrouter-laravel-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/taecontrol/openrouter-laravel-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/taecontrol/openrouter-laravel-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/taecontrol/openrouter-laravel-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/taecontrol/openrouter-laravel-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/taecontrol/openrouter-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/taecontrol/openrouter-laravel-sdk)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require taecontrol/openrouter-laravel-sdk
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="openrouter-laravel-sdk-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="openrouter-laravel-sdk-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="openrouter-laravel-sdk-views"
```

## Usage

```php
$openRouter = new Taecontrol\OpenRouter();
echo $openRouter->echoPhrase('Hello, Taecontrol!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Luis Güette](https://github.com/taecontrol)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
