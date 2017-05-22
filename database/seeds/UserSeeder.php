<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'full_name'=>'Samir Ajdarpasic',
            'username'=>'admin',
            'password'=>bcrypt('123'),
            'email'=>'samir_hajdarpasic@hotmail.com',
            'role'=>'1',
            'system_deleted'=>'0'
        ]);
    }
}
