<?php

declare(strict_types=1);

namespace Vdlp\Glide\Classes;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\FilesystemManager;
use InvalidArgumentException;
use League\Glide\Server;
use League\Glide\ServerFactory;

/**
 * Class GlideManager
 *
 * @package Vdlp\Glide\Classes
 */
class GlideManager
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var FilesystemManager
     */
    protected $filesystemManager;

    /**
     * @var Server[]
     */
    protected $servers = [];

    /**
     * @param Repository $config
     * @param FilesystemManager $filesystemManager
     */
    public function __construct(Repository $config, FilesystemManager $filesystemManager)
    {
        $this->config = $config;
        $this->filesystemManager = $filesystemManager;
    }

    /**
     * @param string|null $name
     * @return Server
     * @throws InvalidArgumentException
     */
    public function server(string $name = null): Server
    {
        $name = $name ?: $this->getDefaultServer();

        if (!isset($this->servers[$name])) {
            $this->servers[$name] = $this->makeServer($name);
        }

        return $this->servers[$name];
    }

    /**
     * @param string|null $name
     * @return Server
     * @throws InvalidArgumentException
     */
    public function reloadServer(string $name = null): Server
    {
        $name = $name ?: $this->getDefaultServer();

        $this->removeServer($name);

        return $this->server($name);
    }

    /**
     * @param string|null $name
     * @return void
     */
    public function removeServer(string $name = null): void
    {
        $name = $name ?: $this->getDefaultServer();
        unset($this->servers[$name]);
    }

    /**
     * @return string
     */
    public function getDefaultServer(): string
    {
        return $this->config->get('glide.default');
    }

    /**
     * @param string $name
     * @return void
     */
    public function setDefaultServer(string $name): void
    {
        $this->config->set('glide.default', $name);
    }

    /**
     * @param string|null $name
     * @return array
     * @throws InvalidArgumentException
     */
    public function getServerConfig(string $name = null): array
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

    /**
     * @param string|null $name
     * @return string
     * @throws InvalidArgumentException
     */
    public function getCacheUrlPath(string $name = null): string
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

    /**
     * @param string $name
     * @return Server
     * @throws InvalidArgumentException
     */
    protected function makeServer(string $name): Server
    {
        $config = $this->getServerConfig($name);
        return $this->createServer($config);
    }

    /**
     * @param array $config
     * @return Server
     */
    protected function createServer(array $config): Server
    {
        return ServerFactory::create($config);
    }
}
