<?php

declare(strict_types=1);

namespace Vdlp\Glide;

use League\Flysystem\Config;
use System\Classes\PluginBase;
use Throwable;
use Vdlp\Glide\Classes\GlideManager;
use Vdlp\Glide\ServiceProviders\GlideServiceProvider;

/**
 * Class Plugin
 *
 * @package Vdlp\Glide
 */
class Plugin extends PluginBase
{
    /**
     * {@inheritdoc}
     */
    public function pluginDetails(): array
    {
        return [
            'name' => 'vdlp.glide::lang.plugin.name',
            'description' => 'vdlp.glide::lang.plugin.description',
            'author' => 'Van der Let & Partners <octobercms@vdlp.nl>',
            'icon' => 'icon-link',
            'homepage' => 'https://octobercms.com/plugin/vdlp-glide',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->register(GlideServiceProvider::class);
    }

    /**
     * {@inheritdoc}
     */
    public function registerMarkupTags(): array
    {
        return [
            'filters' => [
                'thumb' => function (string $path = null, array $options = [], string $servername = null): string {
                    if ($path === null) {
                        return '';
                    }

                    /** @var GlideManager $glideManager */
                    $glideManager = resolve(GlideManager::class);

                    try {
                        /** @var Config $config */
                        /** @noinspection PhpUndefinedMethodInspection */
                        $config = $glideManager->server($servername)->getCache()->getConfig();
                        return $config->get('url', '') . $glideManager->server($servername)->makeImage($path, $options);
                    } catch (Throwable $e) {
                        // TODO: Proper exception handling.
                        return '';
                    }
                },
            ],
        ];
    }
}
