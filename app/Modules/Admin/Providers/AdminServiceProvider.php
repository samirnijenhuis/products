<?php

namespace Snijenhuis\Modules\Admin\Providers;

use App;
use Config;
use Lang;
use View;
use Caffeinated\Modules\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
	/**
	 * Register the Admin module service provider.
	 *
	 * This service provider is a convenient place to register your modules
	 * services in the IoC container. If you wish, you may make additional
	 * methods or service providers to keep the code more focused and granular.
	 *
	 * @return void
	 */
	public function register()
	{
		App::register(\HieuLe\Active\ActiveServiceProvider::class);

		App::register('Snijenhuis\Modules\Admin\Providers\RouteServiceProvider');
		App::register('Snijenhuis\Modules\Admin\Providers\ViewComposerServiceProvider');


		Lang::addNamespace('admin', realpath(__DIR__.'/../Resources/Lang'));
		View::addNamespace('admin', base_path('resources/views/vendor/admin'));
		View::addNamespace('admin', realpath(__DIR__.'/../Resources/Views'));
	}

	/**
	 * Bootstrap the application events.
	 *
	 * Here you may register any additional middleware provided with your
	 * module with the following addMiddleware() method. You may pass in
	 * either an array or a string.
	 *
	 * @return void
	 */
	public function boot()
	{
		// $this->addMiddleware('');
		$this->publishes([
			__DIR__.'/../Resources/Assets' => public_path('assets/modules/admin'),
		], 'modules');
	}

	/**
	 * Additional Compiled Module Classes
	 *
	 * Here you may specify additional classes to include in the compiled file
	 * generated by the `artisan optimize` command. These should be classes
	 * that are included on basically every request into the application.
	 *
	 * @return array
	 */
	public static function compiles()
	{
		$basePath = realpath(__DIR__.'/../');

		return [
			// $basePath.'/example.php',
		];
	}
}
