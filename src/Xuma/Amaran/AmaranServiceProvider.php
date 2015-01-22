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
	 * Register the service provider
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerServices();

		$this->registerResources();
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

		$this->app->bindShared('amaran', function() {
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