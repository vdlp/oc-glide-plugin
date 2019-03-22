<?php

declare(strict_types=1);

namespace Vdlp\Glide\Classes;

use Throwable;
use League\Flysystem\Config;

/**
 * Class GlideHelper
 *
 * @package Vdlp\Glide\Classes
 */
class GlideHelper
{
    /**
     * @var GlideManager
     */
    private $manager;

    /**
     * @param GlideManager $manager
     */
    public function __construct(GlideManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string|null $path
     * @param array $options
     * @param string|null $servername
     * @return string
     */
    public function createThumbnail(string $path = null, array $options = [], string $servername = null): string
    {
        if ($path === null) {
            return '';
        }

        try {
            /** @var Config $config */
            /** @noinspection PhpUndefinedMethodInspection */
            $config = $this->manager->server($servername)
                ->getCache()
                ->getConfig();

            return $config->get('url', '')
                . $this->manager->server($servername)->makeImage($path, $options);
        } catch (Throwable $e) {
            // TODO: Proper exception handling.
            return '';
        }
    }
}
