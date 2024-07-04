# Laravel Package for accessing the Keap REST API (v1)

Let's be honest, the php-infusionsoft SDK is shit.
Barely any support for modern version of PHP and all the laravel packages, such as the upwebdesign one, that has been the main inspiration for this package, rely on the old architecture and legacy version of the Infusionsoft API.

I jump in to ensure a Laravel 11+ support for this package that completely ignores the PHP SDK and builds it's own wrapper using Laravel helpers and architectures.

This package uses OAuth 2 with the REST API v1 or v2 of Keap, **WITHOUT** relying on the SDK of infusionsoft.

You can find a whole website with the documentation for this package at [https://www.laravelkeap.com/](https://www.laravelkeap.com/)

## Installation

To install this package, we need to install the Laravel part and create the API credentials to connect to your Keap Application.

### Laravel set up

To install the package you can use the following command

```bash
composer require keapgeek/laravel-keap
```

then install the package to publish the configuration

```bash
php artisan keap:install
```

In the environment file add the following lines

```bash

KEAP_CLIENT_KEY="Client from the developer account"
KEAP_CLIENT_SECRET="Secret from the developer account"
```

### Keap set up

Before we start installing the package, we need to create a Keap developer account and get our API credentials.
For more information look at the Keap documentation [Visit the Laravel Keap Docs](https://www.laravelkeap.com/get-started?utm_source=github&utm_medium=repository&utm_campaign=readme)
In shorts the steps are repeated here below:

-   Create a Developer Account
-   Generate the Api Keys
-   Authenticate

## First Usage

After installation and having setup the environment variables in the .env file. You can access the `/keap/auth` uri in your browser, even in the local version, to access the
login page of Keap. Once logged in you can authorize the access to a specific app.

I strongly suggest to have a sandbox version of Keap, to test your Api before connecting it to your real app with your clients data.

Automatically keap will redirect you to a confirmation page that will simply say `Access granted!`. From there you can start using the keap service.

### Automatically refresh the Oath token

Keap will transmit an access and refresh token that are stored in the cache, therefore pay attention when you clear it.
The refresh code can be used only for 24 hours. You can refresh the code with the artisan command

```
php artisan keap:refresh
```

You can set up this command in the console `Kernel.php` file to run twice or thrice a day to prevent the code from expiring.

```php
    protected function schedule(Schedule $schedule): void
    {
        // Other scheduled commands
        $schedule->command('keap:refresh')->twiceDaily(1, 13);
    }
```

## Accessing the API

To access the REST API, you can use the `Keap` Facade:

```php
use KeapGeek\Keap\Facades\Keap;

// To access the contacts
Keap::contact();

//To access the campaigns
Keap::campaign();

```

The methods of the Keap Facade allow you to automatically call the API endpoints.

A list of all the available methods are can be found in the [Laravel Keap API Docs](https://www.laravelkeap.com/docs?utm_source=github&utm_medium=repository&utm_campaign=readme)

## Testing

```bash
composer test
```

## Credits

Any help in developing this package is welcome!

-   [Azzarip](https://github.com/Azzarip)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
