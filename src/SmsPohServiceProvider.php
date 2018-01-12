<?php

namespace pyaesone17\SmsPoh;

use Illuminate\Support\ServiceProvider;

class SmsPohServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {   
        $this->app->singleton(SmsPohChannel::class, function ($app) { 
            ['token' => $token, 'end_point' => $endPoint] = $app['config']->get('sms-poh');
            return new SmsPohChannel($token, $endPoint);
        });

        $this->app->singleton(SmsPoh::class, function ($app) { 
            ['token' => $token, 'end_point' => $endPoint] = $app['config']->get('sms-poh');
            return new SmsPoh($token, $endPoint);
        });

        $this->publishes([
            __DIR__.'/config/sms-poh.php' => config_path('sms-poh.php'),
        ], 'config');       
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/sms-poh.php', 'sms-poh'
        );
    }
}