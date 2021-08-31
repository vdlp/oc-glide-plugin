<?php

declare(strict_types=1);

namespace Vdlp\Glide\Classes;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\FilesystemManager;
use InvalidArgumentException;
use League\Glide\Server;
use League\Glide\ServerFactory;

class GlideManager
{
    protected Repository $config;
    protected FilesystemManager $filesystemManager;
    protected array $servers = [];

    public function __construct(Repository $config, FilesystemManager $filesystemManager)
    {
        $this->config = $config;
        $this->filesystemManager = $filesystemManager;
    }

    public function server(?string $name = null): Server
    {
        $name = $name ?: $this->getDefaultServer();

        if (!isset($this->servers[$name])) {
            $this->servers[$name] = $this->makeServer($name);
        }

        return $this->servers[$name];
    }

    public function reloadServer(?string $name = null): Server
    {
        $name = $name ?: $this->getDefaultServer();

        $this->removeServer($name);

        return $this->server($name);
    }

    public function removeServer(?string $name = null): void
    {
        $name = $name ?: $this->getDefaultServer();
        unset($this->servers[$name]);
    }

    public function getDefaultServer(): string
    {
        return (string) $this->config->get('glide.default');
    }

    public function setDefaultServer(string $name): void
    {
        $this->config->set('glide.default', $name);
    }

    /**
     * @throws
     */
    public function getServerConfig(?string $name = null): array
    {
        $name = $name ?: $this->getDefaultServer();

        $configurations = $this->config->get('glide.servers');

        if (!isset($configurations[$name]) || !is_array($configurations[$name])) {
            throw new InvalidArgumentException("Server $name is not properly configured.");
        }

        $config = $configurations[$name];
        $config['name'] = $name;

        if (array_key_exists($config['source'], (array) $this->config->get('filesystems.disks'))) {
            /** @noinspection PhpUndefinedMethodInspection */
            $config['source'] = $this->filesystemManager->disk($config['source'])->getDriver();
        }

        if (array_key_exists($config['cache'], (array) $this->config->get('filesystems.disks'))) {
            /** @noinspection PhpUndefinedMethodInspection */
            $config['cache'] = $this->filesystemManager->disk($config['cache'])->getDriver();
        }

        if (array_key_exists($config['watermarks'], (array) $this->config->get('filesystems.disks'))) {
            /** @noinspection PhpUndefinedMethodInspection */
            $config['watermarks'] = $this->filesystemManager->disk($config['watermarks'])->getDriver();
        }

        return $config;
    }

    public function getCacheUrlPath(?string $name = null): string
    {
        $name = $name ?: $this->getDefaultServer();

        $configurations = $this->config->get('glide.servers');

        if (!isset($configurations[$name]) || !is_array($configurations[$name])) {
            throw new InvalidArgumentException("Server $name is not properly configured.");
        }

        $config = $configurations[$name];

        if (array_key_exists($config['cache'], (array) $this->config->get('filesystems.disks'))) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->filesystemManager->disk($config['cache'])->getUrl();
        }

        return '';
    }

    protected function makeServer(string $name): Server
    {
        $config = $this->getServerConfig($name);

        return $this->createServer($config);
    }

    protected function createServer(array $config): Server
    {
        return ServerFactory::create($config);
    }
}
