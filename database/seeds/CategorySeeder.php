<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' =>'SmartPhone',
            'system_deleted' =>'0'
        ]);

        DB::table('categories')->insert([
            'name' =>'Tablet',
            'system_deleted' =>'0'
        ]);

        DB::table('categories')->insert([
            'name' =>'Accessories',
            'system_deleted' => '0'
        ]);
    }
}
