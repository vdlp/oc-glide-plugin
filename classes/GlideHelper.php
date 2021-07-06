<?php

declare(strict_types=1);

namespace Vdlp\Glide\Classes;

use League\Glide\Urls\UrlBuilderFactory;
use Throwable;

class GlideHelper
{
    private GlideManager $manager;

    public function __construct(GlideManager $manager)
    {
        $this->manager = $manager;
    }

    public function createThumbnail(?string $path = null, array $options = [], ?string $servername = null): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        $servername ??= $this->manager->getDefaultServer();

        try {
            $this->manager->server($servername)
                ->makeImage($path, $options);

            $factory = UrlBuilderFactory::create(
                '/images/' . ($servername ?? 'main') . '/',
                config(sprintf('glide.servers.%s.sign_key', $servername))
            );

            return $factory->getUrl($path, $options);
        } catch (Throwable $e) {
            return '';
        }
    }
}
