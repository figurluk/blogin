<?php
/**
 * Copyright (c) 2016. Lukas Figura
 */

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

/**
 * Class CleanStringServiceProvider
 * @author Lukas Figura <figurluk@gmail.com>
 * @package App\Providers
 */
class CleanStringServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @author Lukas Figura <figurluk@gmail.com>
     * @return void
     */
    public function register()
    {
        App::bind('cleanstring', function () {
            return new \App\Classes\Cleanstring;
        });
    }
}
