<?php

namespace App\Http\Middleware;

use Closure;

class HtmlMinifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $modifiedContent = $this->minifyHTML($response->getContent());

        $response->setContent($modifiedContent);

        return $response;
    }

    public function minifyHTML($content)
    {
        $replace = [
            '/<!--(.|\n)*?-->/' => '', //remove comments
            "/\r/" => '', // remove carriage return
            "/\n/" => '', // remove new lines
            "/\t/" => '', // remove tab
            "/\s+/" => ' ', // remove spaces
        ];

        return preg_replace(array_keys($replace), array_values($replace), $content);
    }
}
