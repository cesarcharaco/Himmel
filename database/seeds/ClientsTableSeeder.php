<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clients')->insert([
        	'name' => 'Jose Quintero',
        	'letter' => 'P',
        	'rif' => 12323323,
        	'address' => 'Sector Centro, calle 2',
        	'email' => 'josequintero@gmail.com',
        	'user_id' => 2
        ]);
        \DB::table('clients')->insert([
        	'name' => 'Carmin Perez',
        	'letter' => 'V',
        	'rif' => 12323389,
        	'address' => 'Sector Centro, calle 5',
        	'email' => 'carminperez@gmail.com',
        	'user_id' => 2
        ]);
        \DB::table('clients')->insert([
        	'name' => 'Armando Torres',
        	'letter' => 'P',
        	'rif' => 12323366,
        	'address' => 'Sector Oeste, calle 2',
        	'email' => 'armandotorres@gmail.com',
        	'user_id' => 3
        ]);
        \DB::table('clients')->insert([
        	'name' => 'Marcos Blancos',
        	'letter' => 'P',
        	'rif' => 12323399,
        	'address' => 'Sector Oeste, calle 1',
        	'email' => 'marcosblancos@gmail.com',
        	'user_id' => 3
        ]);
    }
}
