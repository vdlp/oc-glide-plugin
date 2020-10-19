<?php

declare(strict_types=1);

namespace Vdlp\Glide\ServiceProviders;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use October\Rain\Filesystem\FilesystemManager;
use October\Rain\Support\ServiceProvider;
use Vdlp\Glide\Classes\GlideHelper;
use Vdlp\Glide\Classes\GlideManager;

/**
 * Class GlideServiceProvider
 *
 * @package Vdlp\Glide\ServiceProviders
 */
class GlideServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config.php' => config_path('glide.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'glide');
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(GlideManager::class, function (Container $container): GlideManager {
            return new GlideManager(
                $container->make(Repository::class),
                $container->make(FilesystemManager::class)
            );
        });

        $this->app->singleton(GlideHelper::class, function (Container $container): GlideHelper {
            return new GlideHelper(
                $container->make(GlideManager::class)
            );
        });
    }
}
