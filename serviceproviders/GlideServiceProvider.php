<?php

declare(strict_types=1);

namespace Vdlp\Glide\ServiceProviders;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Filesystem\FilesystemManager;
use October\Rain\Support\ServiceProvider as ServiceProviderBase;
use Vdlp\Glide\Classes\GlideHelper;
use Vdlp\Glide\Classes\GlideManager;

final class GlideServiceProvider extends ServiceProviderBase
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config.php' => config_path('glide.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'glide');
    }

    public function register(): void
    {
        $this->app->singleton(GlideManager::class, static function (Container $container): GlideManager {
            return new GlideManager(
                $container->make(Repository::class),
                $container->make(FilesystemManager::class)
            );
        });

        $this->app->singleton(GlideHelper::class, static function (Container $container): GlideHelper {
            return new GlideHelper(
                $container->make(GlideManager::class)
            );
        });
    }
}
