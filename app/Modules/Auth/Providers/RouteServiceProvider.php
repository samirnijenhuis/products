<?php

namespace Snijenhuis\Modules\Auth\Providers;

use Caffeinated\Modules\Modules as Module;
use Caffeinated\Modules\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * The controller namespace for the module.
	 *
	 * @var string|null
	 */
	protected $namespace = 'Snijenhuis\Modules\Auth\Http\Controllers';

	/**
	 * Define your module's route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		$this->addRouteMiddleware([
			'auth' => \Snijenhuis\Modules\Auth\Http\Middleware\Authenticate::class,
		]);
	}

	/**
	 * Define the routes for the module.
	 *
	 * @param  \Illuminate\Routing\Router $router
	 * @param  \Caffeinated\Modules\Modules $module
	 */
	public function map(Router $router, Module $module)
	{
		if($module->isEnabled('admin')) {

			// This applies the 'auth' middleware to the Admin module routes.
			// We assume that if you use this package and have admin enabled
			// you will be wanting to secure the admin.
			$router->group([
				'namespace' => 'Snijenhuis\Modules\Admin\Http\Controllers',
				'middleware' => ['web', 'auth']
			], function(){
				require (config('modules.path') . '/Admin/Http/routes.php');
			});
		}

		$router->group([
			'namespace'  => $this->namespace,
			'middleware' => ['web']
		], function($router) {
			require (config('modules.path').'/Auth/Http/routes.php');
		});
	}
}
