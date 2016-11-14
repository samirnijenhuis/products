<?php

namespace Snijenhuis\Modules\Auth\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AuthDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->truncateAuthTables();

		$this->call('Snijenhuis\Modules\Auth\Database\Seeds\RoleTableSeeder');
		$this->call('Snijenhuis\Modules\Auth\Database\Seeds\UserTableSeeder');
	}

	private function truncateAuthTables()
	{
		DB::table('users')->truncate();
		DB::table('activations')->truncate();
		DB::table('persistences')->truncate();
		DB::table('reminders')->truncate();
		DB::table('role_users')->truncate();
		DB::table('roles')->truncate();
		DB::table('throttle')->truncate();
	}
}
