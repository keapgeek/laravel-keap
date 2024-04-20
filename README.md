# Laravel Package for accessing the Keap REST API (v1 and v2)

Let's be honest, the php-infusionsoft SDK is shit.
Barely any support for modern version of PHP and all the laravel packages, such as the upwebdesign one, that has been the main inspiration for this package, rely on the old architecture and legacy version of the Infusionsoft API.

I jump in to ensure a Laravel 11+ support for this package that completely ignores the PHP SDK and builds it's own wrapper using Laravel helpers and architectures.

This package uses OAuth 2 with the REST API, to know more you [can visit this website](https://developer.infusionsoft.com/getting-started-oauth-keys/)

## Keap preparation

Before we start installing the package, we need to create a Keap developer account and get our API credentials.
For more information look at the Keap documentation ([Click here to get started](https://developer.keap.com/get-started/))
In shorts the steps are repeated here below:

### Create a new account

Create a keap developer account: [Click here](https://keys.developer.keap.com/accounts/create)

### Create a sandbox

The sandbox account is useful for testing the API calls before using the application on your Keap production app.
Create a new sandbox account: [Click here](https://sandbox.keap.com/)

### Create new APP to access the sandbox version

To create a new app, once logged in with the developer account, access this page: [Click here](https://keys.developer.keap.com/my-apps/new-app)

Add a `name`, a `description` and activate the API, then click on `SAVE`.
You will finally have a `Client Key` and a `Client Secret`.

## Installation

To install the package you can use the following command

```
composer require azzarip/laravel-keap
```

then install the package to publish the configuration

```
php artisan keap:install
```

In the environment file add the following lines

```
// .env

KEAP_CLIENT_KEY = "Keap from the developer account"
KEAP_CLIENT_SECRET = "Secret from the developer account"
```
## Usage

After installation and having setup the environment variables in the .env file. You can access the `/keap/auth` uri in your browser, even in the local version, to access the
login page of Keap. Once logged in you can authorize the access to a specific app.
Automatically keap will redirect you to a confirmation page that will simply say `Access granted!`. From there you can start using the keap service.

### Access Code
Keap will transmit an access and refresh token that are stored in the cache, therefore pay attention when you clear it.
The refresh code can be used only for 24 hours. You can refresh the code with the artisan command
```
php artisan keap:refresh
```
You can set up this command in the `Kernel.php` console file to run twice or thrice a day to prevent the code from expiring.
## Testing

```bash
composer test
````

## Credits

Any help in developing this package is welcome!

-   [Azzarip](https://github.com/Azzarip)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
