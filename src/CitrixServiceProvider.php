<?php

namespace Slakbal\Citrix;

use Illuminate\Support\ServiceProvider;

class CitrixServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;


    public function register()
    {
        //runtime merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/citrix.php', 'citrix');
        $this->registerGotoWebinar(config('citrix.auth_type'));
        //$this->registerGotoMeeting(config('citrix.auth_type'));
    }


    public function registerGotoWebinar($authType = 'direct')
    {
        $this->app->singleton(Webinar::class, function ($app) use ($authType) {
            return new Webinar($authType);
        });
    }


    public function registerGotoMeeting($authType = 'direct')
    {
        $this->app->singleton(Meeting::class, function ($app) use ($authType) {
            return new Meeting($authType);
        });
    }


    //the boot method runs on every application request when the service providers are booted up
    public function boot()
    {
        //load the routes file
        require __DIR__ . '/../http/routes.php';
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Webinar::class,
            //Meeting::class,
        ];
    }
}