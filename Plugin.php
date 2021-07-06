<?php

declare(strict_types=1);

namespace Vdlp\Glide;

use System\Classes\PluginBase;
use Vdlp\Glide\Classes\GlideHelper;

class Plugin extends PluginBase
{
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

    public function register(): void
    {
        $this->app->register(ServiceProvider::class);
    }

    public function registerMarkupTags(): array
    {
        return [
            'filters' => [
                'thumb' => static function (?string $path = null, array $options = [], ?string $servername = null): string {
                    /** @var GlideHelper $helper */
                    $helper = resolve(GlideHelper::class);

                    return $helper->createThumbnail($path, $options, $servername);
                },
            ],
        ];
    }
}
