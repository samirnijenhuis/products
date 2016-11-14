<?php

use Illuminate\Database\Seeder;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock')->truncate();
        DB::table('stock')->insert(['option' => 'Immediately']);
        DB::table('stock')->insert(['option' => 'Within 5 days']);
        DB::table('stock')->insert(['option' => 'Out of stock']);
    }
}
