<?php

namespace Jlbousing\LaravelLinkedinLearning\Providers;

use Illuminate\Support\ServiceProvider;
use Jlbousing\LaravelLinkedinLearning\Services\LinkedinLearningService;

class LinkedinLearningServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publicar archivos de configuración, migraciones, vistas, etc.
        $this->publishes([
            __DIR__.'/../../config/linkedin-learning.php' => config_path('linkedin-learning.php'),
        ], 'config');
    }

    public function register()
    {
        // Registrar el servicio en el contenedor de Laravel
        $this->app->singleton(LinkedinLearningService::class, function ($app) {
            return new LinkedinLearningService();
        });
    }
}