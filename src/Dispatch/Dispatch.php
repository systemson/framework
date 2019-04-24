<?php

namespace Amber\Framework\Dispatch;

use Amber\Container\Container;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Amber\Framework\Response;

class Dispatch
{
    /**
     * @var The DI container.
     */
    protected $container;

    protected $request;

    public function __construct(Container $container, Request $request)
    {
        $this->container = $container;
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function response()
    {
        $request = $this->getRequest();

        try {
            $matcher = $this->container->get(UrlMatcher::class);
            $path = $request->getPathInfo();

            $default = (object) $matcher->match($path);
        } catch (ResourceNotFoundException $e) {
            return Response::notFound($e->getMessage());
        }


        if (isset($default->_controller)) {
            return $this->handleClass($default);
        } elseif (isset($default->_callback)) {
            return $this->handleClosure($default);
        }

        //return new Response(parse_str($default));
    }

    protected function handleClass($default)
    {
        $controller = $default->_controller;

        $callback = $this->container->getClosureFor($controller, $default->_action);

        return $callback();
    }

    protected function handleClosure(Closure $callback)
    {
        return $callback();
    }
}
