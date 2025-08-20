<?php

declare(strict_types=1);

namespace Vdlp\Glide\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\Signatures\SignatureFactory;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Vdlp\Glide\Classes\GlideManager;

final class Image extends Controller
{
    private Request $request;
    private GlideManager $glideManager;
    private SymfonyResponseFactory $responseFactory;

    public function __construct(
        Request $request,
        GlideManager $glideManager,
        SymfonyResponseFactory $responseFactory
    ) {
        $this->request = $request;
        $this->glideManager = $glideManager;
        $this->responseFactory = $responseFactory;
    }

    public function download(string $servername, string $path): Response
    {
        try {
            $signature = SignatureFactory::create(config(sprintf('glide.servers.%s.sign_key', $servername)));
            $signature->validateRequest(str_replace('%20', ' ', $this->request->path()), $this->request->all());
        } catch (Throwable $throwable) {
            return new Response('Not Found', 404);
        }

        $server = $this->glideManager->server($servername);
        $server->setResponseFactory($this->responseFactory);

        try {
            return $server->getImageResponse($path, $this->request->all());
        } catch (Throwable $throwable) {
            return new Response('Not Found', 404);
        }
    }
}
