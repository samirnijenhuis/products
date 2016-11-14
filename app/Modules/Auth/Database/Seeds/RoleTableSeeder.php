<?php

namespace Snijenhuis\Modules\Auth\Database\Seeds;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleTableSeeder extends Seeder
{
	protected $sentinel;

	private $roles = [
		'Super admin' => [
			'name' => 'Super admin', 'slug' => 'super_admin'
		],

		'Admin' => [
			'name' => 'Admin', 'slug' => 'admin'
		],

		'Guest' => [
			'name' => 'Guest', 'slug' => 'guest'
		]
	];

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
		foreach($this->roles as $role) {
			$this->sentinel->getRoleRepository()->createModel()->create($role);
		}
	}
	
}
