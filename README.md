# Hydro Core

[![Packagist](https://img.shields.io/packagist/v/koraycicekciogullari/hydro-core.svg)](https://packagist.org/packages/koraycicekciogullari/hydro-core)
[![Packagist](https://poser.pugx.org/koraycicekciogullari/hydro-core/d/total.svg)](https://packagist.org/packages/koraycicekciogullari/hydro-core)
[![Packagist](https://img.shields.io/packagist/l/koraycicekciogullari/hydro-core.svg)](https://packagist.org/packages/koraycicekciogullari/hydro-core)

# Installation

Install via composer
```bash
composer require koraycicekciogullari/hydro-core
```

# Publish package assets

```bash
php artisan vendor:publish --provider="Koraycicekciogullari\HydroCore\ServiceProvider"
```

# Update the files below.

#### cors.php File Must Be Replaced.
```php
'supports_credentials' => true,
```

#### auth.php File Must Be Replaced.
```php
use Koraycicekciogullari\HydroAdministrator\Models\User;

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
    ],
],
```

#### Kernel.php File Must Be Replaced.
```php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],

protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
];
```

#### .env File Must Be Replaced.
```
FILESYSTEM_DRIVER=media
SESSION_DRIVER=cookie
ANALYTICS_VIEW_ID=
GOOGLE_RECAPTCHA_SECRET_KEY=
MEDIA_DISK="media"
```

#### composer.json File Must Be Replaced.
```
"post-autoload-dump": [
    "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
    "@php artisan package:discover --ansi",
    "@php artisan ide-helper:generate",
    "@php artisan ide-helper:meta",
    "@php artisan ide-helper:models --write-mixin"
],
```

#### Add config/values.php
```php
<?php

return [
    'google_recaptcha_secret_key' => env('GOOGLE_RECAPTCHA_SECRET_KEY')
];
```

#### AuthServiceProvider.php File Must Be Replaced.
```php
Gate::before(function ($user, $ability) {
    return $user->hasRole('root') ? true : null;
});
```

# Installation Steps
The commands below are run sequentially.
```bash
php artisan vendor:publish --provider="Spatie\Analytics\AnalyticsServiceProvider"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"
php artisan storage:link
php artisan optimize
php artisan migrate
```
