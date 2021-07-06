<?php

declare(strict_types=1);

use Illuminate\Routing\Router;

/** @var Router $router */
$router = resolve(Router::class);
$router->get(
    '/images/{servername}/{path}',
    'Vdlp\Glide\Controllers\Image@download'
)->where('path', '.+');
