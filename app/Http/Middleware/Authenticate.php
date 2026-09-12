<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $appUrl = rtrim(config('app.url', ''), '/');
            $appPath = parse_url($appUrl, PHP_URL_PATH) ?: '';
            $path = '/' . ltrim($request->path(), '/');

            if ($appPath && !str_starts_with($path, $appPath)) {
                $intended = $appUrl . $path;
            } else {
                $intended = $appUrl . $path;
            }

            if ($qs = $request->getQueryString()) {
                $intended .= '?' . $qs;
            }

            session()->put('url.intended', $intended);

            return route('login');
        }
    }
}
