<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        if (config('app.url')) {
            \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
        }
        if (str_starts_with(config('app.url', ''), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        if (class_exists(\Inertia\Inertia::class)) {
            \Inertia\Inertia::resolveUrlUsing(function (\Illuminate\Http\Request $request) {
                $prefix = parse_url(config('app.url', ''), PHP_URL_PATH) ?: '';
                $url = \Illuminate\Support\Str::start(
                    \Illuminate\Support\Str::after($request->fullUrl(), $request->getSchemeAndHttpHost()),
                    '/'
                );
                if ($prefix && !str_starts_with($url, $prefix)) {
                    $url = $prefix . $url;
                }
                return $url;
            });
        }
    }
}
