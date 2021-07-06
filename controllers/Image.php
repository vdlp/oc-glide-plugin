<?php

declare(strict_types=1);

namespace Vdlp\Glide\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\Glide\Filesystem\FileNotFoundException;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Signatures\SignatureException;
use League\Glide\Signatures\SignatureFactory;
use Symfony\Component\HttpFoundation\Response;
use Vdlp\Glide\Classes\GlideManager;

final class Image extends Controller
{
    private Request $request;
    private GlideManager $glideManager;
    private LaravelResponseFactory $responseFactory;

    public function __construct(
        Request $request,
        GlideManager $glideManager,
        LaravelResponseFactory $responseFactory
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
        } catch (SignatureException $e) {
            return new Response('Not Found', 404);
        }

        $this->glideManager->server($servername)
            ->setResponseFactory($this->responseFactory);

        try {
            return $this->glideManager->server($servername)
                ->getImageResponse($path, $this->request->all());
        } catch (FileNotFoundException $e) {
            return new Response('Not Found', 404);
        }
    }
}
