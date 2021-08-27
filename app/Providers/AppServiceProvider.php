<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\ServiceProvider;

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
        // $this->app->bind('path.public', function () {
        //     return realpath(base_path() . '/../public_html');
        // });

        Inertia :: version (function () {
            return md5_file (public_path ('mix-manifest.json'));
        });
    }
}
