<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('brands')->insert([
          'name' =>'Apple',
          'info'=>'',
          'country'=>'USA',
          'city'=>'California',
      ]);
      DB::table('brands')->insert([
          'name' =>'Samsung',
          'info'=>'',
          'country'=>'Korea',
          'city'=>'',
      ]);
      DB::table('brands')->insert([
          'name' =>'Google',
          'info'=>'',
          'country'=>'USA',
          'city'=>'California',
      ]);
    }
}
