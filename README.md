# Laravel Currency Converter

A Laravel 12 currency converter that shows live exchange rates and converts amounts between currencies, using ExchangeRate-API.

## Features

- **Live rates:** the currency list comes from the latest rates on every page load
- **Conversion** between any two supported currencies, using the API's pair endpoint
- **Service layer:** API calls live in `CurrencyConversionService`, injected into the controller, with the HTTP client registered as a singleton in the service container
- **Validation** of the amount and both currencies before any API call
- **Form state kept** after conversion, so the result shows beside the values you entered
- **API key in `.env`**, read through `config/services.php`

## Tech stack

PHP 8.2+, Laravel 12, Guzzle, Blade and SQLite (for Laravel's sessions and cache).

## Getting started

You need PHP 8.2 or newer, Composer, and a free API key from [ExchangeRate-API](https://www.exchangerate-api.com).

```bash
git clone https://github.com/abdullahrather/laravel-currency-converter.git
cd laravel-currency-converter
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

Add your key to `.env`:

```dotenv
EXCHANGE_RATE_API_KEY=your-key-here
```

Then start the app and open http://localhost:8000:

```bash
php artisan serve
```

`certificates/cacert.pem` is a CA bundle for HTTPS requests, for PHP installs (common on Windows) that don't have one configured.

## How it works

| Piece | File |
|---|---|
| Routes, `GET /` and `POST /convert` | `routes/web.php` |
| Controller | `app/Http/Controllers/CurrencyConvertController.php` |
| API service | `app/Services/CurrencyConversionService.php` |
| HTTP client set-up | `app/Providers/AppServiceProvider.php` |
| Page | `resources/views/index.blade.php` |

## Tests

```bash
php artisan test
```

## License

MIT
