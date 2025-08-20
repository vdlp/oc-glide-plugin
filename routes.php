<?php

declare(strict_types=1);

use Illuminate\Routing\Router;
use Vdlp\Glide\Controllers\Image;

/** @var Router $router */
$router = resolve(Router::class);
$router->get(
    '/images/{servername}/{path}',
    [Image::class, 'download'],
)->where('path', '.+');
