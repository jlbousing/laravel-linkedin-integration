# Laravel LinkedIn Learning API Integration

[![Latest Version](https://img.shields.io/packagist/v/jlbousing/laravel-linkedin-learning.svg?style=flat-square)](https://packagist.org/packages/jlbousing/laravel-linkedin-learning)
[![License](https://img.shields.io/packagist/l/jlbousing/laravel-linkedin-learning.svg?style=flat-square)](https://packagist.org/packages/jlbousing/laravel-linkedin-learning)

Este paquete proporciona una integración sencilla con la API de LinkedIn Learning para proyectos Laravel. Con este paquete, puedes obtener tokens de acceso, buscar en el catálogo de cursos y obtener detalles de los recursos de aprendizaje.

---

## Requisitos

- PHP 7.4 o superior.
- Laravel 8.x, 9.x o 10.x.
- Credenciales de la API de LinkedIn Learning (`client_id`, `client_secret` y `api_url`).

---

## Instalación

Puedes instalar el paquete a través de Composer:

```bash
composer require jlbousing/laravel-linkedin-learning
```

# Configuración

Publica el archivo de configuración del paquete

```bash
php artisan vendor:publish --provider="Jlbousing\LaravelLinkedinLearning\Providers\LinkedinLearningServiceProvider" --tag="config"
```
Esto creará un archivo de configuración en config/linkedin-learning.php.

Actualiza el archivo de configuración con tus credenciales de LinkedIn Learning:
```bash
return [
    'client_id' => env('LINKEDIN_LEARNING_CLIENT_ID'),
    'client_secret' => env('LINKEDIN_LEARNING_CLIENT_SECRET'),
    'api_url' => env('LINKEDIN_LEARNING_API_URL'),
];
```
Asegúrate de agregar las siguientes variables de entorno en tu archivo .env:
```bash
LINKEDIN_LEARNING_CLIENT_ID=your_client_id
LINKEDIN_LEARNING_CLIENT_SECRET=your_client_secret
LINKEDIN_LEARNING_API_URL=your_api_url
```

# Uso

1. Instalar el proyecto usando el repositorio remoto de github:
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

2. Obtener un Token de Acceso
   Para obtener un token de acceso, puedes usar el método getAccessToken del servicio LinkedinLearningService:
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
3. Buscar en el Catálogo de Cursos
   Para buscar en el catálogo de cursos, usa el método getAllCatalog:
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
4. Obtener Detalles de un Recurso
   Para obtener detalles de un recurso específico, usa el método getAssetDetail:
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

# Ejemplos de DTO
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

# Registro de Errores
El paquete utiliza el sistema de registro de Laravel (Log) para registrar errores. Puedes encontrar los registros en storage/logs/laravel.log.

# Contribuciones
Si deseas contribuir a este proyecto, por favor sigue estos pasos:

Haz un fork del repositorio.

Crea una rama para tu nueva funcionalidad (git checkout -b feature/nueva-funcionalidad).

Realiza tus cambios y haz commit (git commit -am 'Agrega nueva funcionalidad').

Haz push a la rama (git push origin feature/nueva-funcionalidad).

Abre un Pull Request.

¡Gracias por usar jlbousing/laravel-linkedin-learning! Si tienes alguna pregunta o sugerencia, no dudes en abrir un issue en el repositorio.

```bash

### Instrucciones para usar este archivo:
1. Copia el contenido anterior.
2. Pégalo en un archivo llamado `README.md` en la raíz de tu proyecto.
3. Personaliza los detalles según sea necesario (por ejemplo, ajusta los ejemplos o agrega más secciones).

¡Y eso es todo! Ahora tienes un `README.md` profesional y completo para tu paquete. 🚀
```