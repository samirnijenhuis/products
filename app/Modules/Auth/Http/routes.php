<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => config('snijenhuis.auth.route.prefix')], function() {
	Route::get('/test', function(){
		social_available();
	});
	Route::get('login', ['as' => 'auth.login.get', 'uses' => 'AuthController@getLogin']);
	Route::post('login', ['as' => 'auth.login.post', 'uses' => 'AuthController@postLogin']);
	Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout', 'middleware' => 'auth']);


	Route::group(['prefix' => 'password'], function() {
		Route::get('reset', ['as' => 'auth.password.reset.get', 'uses' => 'PasswordController@getReset']);
		Route::post('reset', ['as' => 'auth.password.reset.post', 'uses' => 'PasswordController@postReset']);
		Route::get('create/{code}/{id}', ['as' => 'auth.password.create.get', 'uses' => 'PasswordController@getCreate']);
		Route::post('create/{code}/{id}', ['as' => 'auth.password.create.post', 'uses' => 'PasswordController@postCreate']);
	});

	if(social_enabled()) {
		Route::get('oauth/{provider}', ['as' => 'auth.social.redirect', 'uses' => 'SocialController@redirectToProvider']);
		Route::get('oauth/{provider}/callback', ['as' => 'auth.social.callback', 'uses' => 'SocialController@handleProviderCallback']);
	}

	if(config('snijenhuis.auth.register.enabled')) {
		Route::get('register', ['as' => 'auth.register.get', 'uses' => 'AuthController@getRegister']);
		Route::post('register', ['as' => 'auth.register.post', 'uses' => 'AuthController@postRegister']);
		Route::get('register/activate/{code}', ['as' => 'auth.register.activate', 'uses' => 'AuthController@getActivate']);
	}


});

