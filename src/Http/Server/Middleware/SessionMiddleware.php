<?php

namespace Amber\Framework\Http\Server\Middleware;

use Amber\Framework\Container\Facades\Session;
use Amber\Framework\Container\Facades\Auth;
use Amber\Framework\Container\Facades\Cache;
use Amber\Framework\Auth\UserProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

/**
 * Participant in processing a server request and response.
 *
 * An HTTP middleware component participates in processing an HTTP message:
 * by acting on the request, generating the response, or forwarding the
 * request to a subsequent middleware and possibly acting on its response.
 */
class SessionMiddleware extends RequestMiddleware
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(Request $request, Handler $handler): Response
    {
        if (Session::has('_token')) {
            $token = Session::get('_token');

            if (Cache::has($token)) {
                $user = Cache::get($token);
            } else {
                $userProvider = $this->getContainer()->get(UserProvider::class);
                $user = $userProvider->getUserByToken($token);
            }
            Auth::setUser($user);
        }

        return $this->next($handler);
    }
}
