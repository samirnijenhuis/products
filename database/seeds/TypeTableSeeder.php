<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->truncate();
        DB::table('types')->insert(['name' => 'Clothing']);
        DB::table('types')->insert(['name' => 'Food']);
    }
}
