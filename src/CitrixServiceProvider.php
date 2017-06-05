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
    }


    public function registerGotoWebinar($authType = 'direct')
    {
        $this->app->singleton(Webinar::class, function ($app) use ($authType) {
            return new Webinar($authType);
        });
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
        ];
    }
}