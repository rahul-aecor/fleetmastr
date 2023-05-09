<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Symfony\Component\HttpFoundation\Cookie;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/templates/questionImage', '/templates/attachment'
    ];
	
	public function handle($request, Closure $next)
	{
	    if ( ! $request->is('api/*'))
	    {
	        return parent::handle($request, $next);
	    }
	    return $next($request);
	}

	/**
	 * Add the CSRF token to the response cookies.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Illuminate\Http\Response  $response
	 * @return \Illuminate\Http\Response
	 */
	protected function addCookieToResponse($request, $response)
	{
	    $response->headers->setCookie(
	        new Cookie('XSRF-TOKEN',
	            $request->session()->token(),
	            time() + 60 * ( 60 * 24 * 2) ,
	            '/',
	            null,
	            config('session.secure'),
	            true)
	    );

	    return $response;
	}
}
