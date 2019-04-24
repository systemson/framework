<?php

namespace Amber\Framework\Http\Server;

use Amber\Container\Container;
use Amber\Framework\Middleware\MiddlewareCollection;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class RequestHandler implements RequestHandlerInterface
{
    protected $middlewares = [];
    protected $response;

    public function __construct(Container $container, Response $response)
    {
        $this->setContainer($container);
        $this->setResponse($response);
    }

    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function newResponse(): Response
    {
        return $this->responseFactory();
    }

    protected function responseFactory(): Response
    {
        return $this->getContainer()->get(Response::class);
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(Request $request): Response
    {
        $defaults = $this->match($request);
        $middlewares = $defaults['_middlewares'] ?? [];

        if (!is_null($response = $this->middlewares($request, $middlewares))) {
            return $response;
        }

        return $this->getResponse();
    }

    protected function match(Request $request)
    {
        $matcher = $this->container->get(UrlMatcher::class);
        $uri = $request->getUri();

        return $matcher->match($uri->getpath());
    }

    protected function middlewares(Request $request, $middlewares = [])
    {
        foreach ($middlewares as $class) {
            $middleware = $this->getContainer()->make($class);

            $response = $middleware->process($request, $this);

            if ($response !== $this->getResponse()) {
                return $response;
                break;
            }
        }
    }
}
