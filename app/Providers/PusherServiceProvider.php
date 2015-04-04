<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Pusher;

class PusherServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('Pusher',function($app)
		{
			$keys = $app['config']->get('services.pusher');
			return new Pusher($keys['public'], $keys['secret'], $keys['app_id']);
		});
	}

}
