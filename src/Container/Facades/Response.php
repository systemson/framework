<?php

namespace Amber\Framework\Container\Facades;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Amber\Framework\Container\ContainerFacade;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Response extends ContainerFacade
{
    /**
     * @var string The class accessor.
     */
    protected static $accessor = SymfonyResponse::class;

    /**
     * @var mixed The instance of the accessor.
     */
    protected static $instance;

    /**
     * To expose publicy a method it should be declared protected.
     *
     * @var array The method(s) that should be publicly exposed.
     */
    protected static $passthru = [];

    public static function notFound(string $message = 'Not found!')
    {
        $response = clone static::getInstance();

        $response->setStatusCode(404);
        $response->setContent($message);

        return $response;
    }


    public static function forbidden(string $message = 'Not found!')
    {
        $response = clone static::getInstance();

        $response->setStatusCode(503);
        $response->setContent($message);

        return $response;
    }

    public static function json($data = null)
    {
        return new JsonResponse($data);
    }

    public static function redirect(string $to)
    {
        return new RedirectResponse($to);
    }
}
