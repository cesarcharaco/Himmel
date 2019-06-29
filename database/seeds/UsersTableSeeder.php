<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
        	'name' => 'Administrador',
        	'email' => 'p.arrocet@eiche.cl',
        	'password' => bcrypt('123456'),
        	'user_type' => 'Admin',
        	'log_enterprise' =>''
        ]);
        \DB::table('users')->insert([
            'name' => 'Cesar',
            'email' => 'c.characo@eiche.cl',
            'password' => bcrypt('123456'),
            'user_type' => 'Gerente',
            'log_enterprise' =>''
        ]);
        \DB::table('users')->insert([
            'name' => 'Pablo',
            'email' => 'p.perez@eiche.cl',
            'password' => bcrypt('123456'),
            'user_type' => 'Gerente',
            'log_enterprise' =>''
        ]);
    }
}
