<?php

namespace Amber\Framework\Container\Providers;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Session\Session;
use Amber\Framework\Auth\UserProvider;
use Amber\Framework\Auth\AuthClass;
use Amber\Framework\Container\Facades\Cache;
use Amber\Framework\Container\Facades\Session as SessionFacade;
use Psr\Http\Message\RequestHandlerInterface;
use Amber\Framework\Http\Server\RequestHandler;
use Psr\Http\Message\ServerRequestInterface;
use Amber\Framework\Http\Message\PsrSymfonyBridge\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Amber\Framework\Http\Message\PsrSymfonyBridge\Response;
use Psr\Http\Message\UriInterface;
use Amber\Framework\Http\Message\PsrSymfonyBridge\Uri;
use Amber\Framework\Helpers\Hash;
use Carbon\Carbon;
use Amber\Framework\Http\Security\Csrf;

class HttpServiceProvider extends ServiceProvider
{
    public function setUp(): void
    {
        $container = static::getContainer();

        $container->singleton(RouteCollection::class);

        $container->register(Request::class)
            ->setInstance(Request::createFromGlobals());

        $container->singleton(RequestContext::class)
            ->afterConstruct(
                'fromRequest',
                function () use ($container) {
                    return $container->get(Request::class);
                }
            );

        $container->singleton(Session::class);

        $container->register(ServerRequest::class, ServerRequestInterface::class);
        $container->register(Response::class, ResponseInterface::class);
        $container->register(RequestHandler::class, RequestHandlerInterface::class);
        $container->register(Uri::class, UriInterface::class);
        $container->singleton(Csrf::class);
    }
}
