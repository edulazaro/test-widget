<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\OpenWeatherMapApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Http\Services\WeatherClientInterface', function() {
			return new OpenWeatherMapApiClient();
		});
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
