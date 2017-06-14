<?php

namespace Xuma\Amaran;

use Illuminate\Support\ServiceProvider;

class AmaranServiceProvider extends ServiceProvider
{
    /**
     * Indicates of loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();

        $this->registerResources();
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/amaran.php' => config_path('amaran.php'),
            __DIR__.'/Assets/amaran.min.css' => public_path('/css/amaran.min.css'),
            __DIR__.'/Assets/jquery.amaran.min.js' => public_path('/js/jquery.amaran.min.js'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['amaran'];
    }

    /**
     * Register the package services.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->bind(
            'Xuma\Amaran\ViewBinder',
            'Xuma\Amaran\AmaranViewBinder'
        );

        $this->app->singleton('amaran', function($app) {
            $binder = new AmaranViewBinder($app['events']);

            return $this->app->make('Xuma\Amaran\AmaranHandler');
        });
    }

    /**
     * Register the package resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        // Add a view namespace
        $this->app['view']->addNamespace('amaran', __DIR__.'/../views');
    }
}
