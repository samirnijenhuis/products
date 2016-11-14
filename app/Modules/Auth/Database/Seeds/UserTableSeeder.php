<?php

namespace Snijenhuis\Modules\Auth\Database\Seeds;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
	protected $sentinel;

	public function __construct(Sentinel $sentinel)
	{
		$this->sentinel = $sentinel;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$admin = $this->sentinel->registerAndActivate([
			'email' => 'admin@admin.com',
			'password' => 'admin',
			'first_name' => 'John',
			'last_name' => 'Doe'
		]);

		$admin_role = $this->sentinel->findRoleBySlug('admin');
		$admin_role->users()->attach($admin);


	}
}
