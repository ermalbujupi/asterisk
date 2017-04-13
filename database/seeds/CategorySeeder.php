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
        ]);

        DB::table('categories')->insert([
            'name' =>'Tablet',
        ]);

        DB::table('categories')->insert([
            'name' =>'Accessories',
        ]);
    }
}
