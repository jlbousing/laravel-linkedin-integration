# Laravel LinkedIn Learning API Integration

[![Latest Version](https://img.shields.io/packagist/v/jlbousing/laravel-linkedin-learning.svg?style=flat-square)](https://packagist.org/packages/jlbousing/laravel-linkedin-learning)
[![License](https://img.shields.io/packagist/l/jlbousing/laravel-linkedin-learning.svg?style=flat-square)](https://packagist.org/packages/jlbousing/laravel-linkedin-learning)

This package provides an easy integration with the LinkedIn Learning API for Laravel projects. With this package, you can obtain access tokens, search the course catalog, and retrieve details of learning assets.

---

## Requisitos

- PHP 7.4 or higher.
- Laravel 8.x, 9.x, or 10.x
- LinkedIn Learning API credentials (client_id, client_secret, and api_url).

---

## Installation

You can install the package via Composer:

```bash
composer require jlbousing/laravel-linkedin-learning
```

# Configuration

Publish the package configuration file:

```bash
php artisan vendor:publish --provider="Jlbousing\LaravelLinkedinLearning\Providers\LinkedinLearningServiceProvider" --tag="config"
```
This will create a configuration file at config/linkedin-learning.php.

Update the configuration file with your LinkedIn Learning credentials:
```bash
return [
    'client_id' => env('LINKEDIN_LEARNING_CLIENT_ID'),
    'client_secret' => env('LINKEDIN_LEARNING_CLIENT_SECRET'),
    'api_url' => env('LINKEDIN_LEARNING_API_URL'),
];
```
Make sure to add the following environment variables to your .env file:
```bash
LINKEDIN_LEARNING_CLIENT_ID=your_client_id
LINKEDIN_LEARNING_CLIENT_SECRET=your_client_secret
LINKEDIN_LEARNING_API_URL=your_api_url
```

# Usage

1. Install the project using the remote GitHub repository:
```php
{
    "repositories": [
        {
            "type": "path",
            "url": "../ruta/de/tu/paquete",
            "options": {
                "symlink": true
            }
        }
    ],
    "require": {
        "jlbousing/laravel-linkedin-learning": "*"
    }
}
```

2. Obtain an Access Token
To obtain an access token, use the getAccessToken method from the LinkedinLearningService:
```php
use Jlbousing\LaravelLinkedinLearning\Services\LinkedinLearningService;

class SomeController extends Controller
{
    protected $linkedinLearningService;

    public function __construct(LinkedinLearningService $linkedinLearningService)
    {
        $this->linkedinLearningService = $linkedinLearningService;
    }

    public function getToken()
    {
        try {
            $response = $this->linkedinLearningService->getAccessToken();
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
```
3. Search the Course Catalog
To search the course catalog, use the getAllCatalog method:
```php
use Jlbousing\LaravelLinkedinLearning\Services\LinkedinLearningService;
use Jlbousing\LaravelLinkedinLearning\DTO\CatalogSearchDTO;

class SomeController extends Controller
{
    protected $linkedinLearningService;

    public function __construct(LinkedinLearningService $linkedinLearningService)
    {
        $this->linkedinLearningService = $linkedinLearningService;
    }

    public function searchCatalog()
    {
        try {
            $catalogSearchDTO = new CatalogSearchDTO([
                'accessToken' => 'your_access_token',
                'assetType' => 'COURSE',
                'language' => 'en',
                'country' => 'US',
                'page' => 0,
                'perPage' => 10,
            ]);

            $response = $this->linkedinLearningService->getAllCatalog($catalogSearchDTO);
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
```
4. Get Asset Details
To get details of a specific asset, use the getAssetDetail method:
```php
use Jlbousing\LaravelLinkedinLearning\Services\LinkedinLearningService;
use Jlbousing\LaravelLinkedinLearning\DTO\AssetDetailDTO;

class SomeController extends Controller
{
    protected $linkedinLearningService;

    public function __construct(LinkedinLearningService $linkedinLearningService)
    {
        $this->linkedinLearningService = $linkedinLearningService;
    }

    public function getAssetDetails()
    {
        try {
            $assetDetailDTO = new AssetDetailDTO([
                'accessToken' => 'your_access_token',
                'urn' => 'urn:li:learningAsset:123456',
            ]);

            $response = $this->linkedinLearningService->getAssetDetail($assetDetailDTO);
            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
```

# DTO Examples
CatalogSearchDTO

```php
use Jlbousing\LaravelLinkedinLearning\DTO\CatalogSearchDTO;

$catalogSearchDTO = new CatalogSearchDTO([
    'accessToken' => 'your_access_token',
    'assetType' => 'COURSE',
    'language' => 'en',
    'country' => 'US',
    'page' => 0,
    'perPage' => 10,
]);
```

AssetSearchDTO

```php
use Jlbousing\LaravelLinkedinLearning\DTO\AssetSearchDTO;

$assetSearchDTO = new AssetSearchDTO([
    'accessToken' => 'your_access_token',
    'keyword' => 'Laravel',
    'page' => 0,
    'perPage' => 10,
]);
```

AssetDetailDTO

```php
use Jlbousing\LaravelLinkedinLearning\DTO\AssetDetailDTO;

$assetDetailDTO = new AssetDetailDTO([
    'accessToken' => 'your_access_token',
    'urn' => 'urn:li:learningAsset:123456',
]);
```

# Error Logging
The package uses Laravel's logging system to record errors. You can find the logs in storage/logs/laravel.log.

# Contributions
If you would like to contribute to this project, please follow these steps:

Fork the repository.

Create a branch for your new feature (git checkout -b feature/new-feature)

Make your changes and commit them (git commit -am 'Add new feature').

Push to the branch (git push origin feature/new-feature).

Open a Pull Request.

Thank you for using jlbousing/laravel-linkedin-learning! If you have any questions or suggestions, feel free to open an issue in the repository.

```bash

### Instrucciones para usar este archivo:
1. Copia el contenido anterior.
2. Pégalo en un archivo llamado `README.md` en la raíz de tu proyecto.
3. Personaliza los detalles según sea necesario (por ejemplo, ajusta los ejemplos o agrega más secciones).

¡Y eso es todo! Ahora tienes un `README.md` profesional y completo para tu paquete. 🚀
```
