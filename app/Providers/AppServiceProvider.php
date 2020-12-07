<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Support\Facades\View;
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
	    setlocale(LC_TIME, config('app.locale_php'));

//	    View::composer('*', function ($view) {
//		    $view->with('channels', Channel::all());
//	    });


	    \Validator::extend('spamfree', 'App\Rules\SpamFree@passes');
    }
}
