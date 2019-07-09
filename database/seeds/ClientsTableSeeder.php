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
        	'rut' => '12323323',
        	'address' => 'Sector Centro, calle 2',
            'phone' => '2121223232',
        	'email' => 'jcesarchg9@gmail.com',
        	'user_id' => 2
        ]);
        \DB::table('clients')->insert([
        	'name' => 'Carmin Perez',
        	'rut' => '12323326',
        	'address' => 'Sector Centro, calle 5',
            'phone' => '2121223232',
        	'email' => 'carminperez@gmail.com',
        	'user_id' => 2
        ]);
        \DB::table('clients')->insert([
        	'name' => 'Armando Torres',
        	'rut' => '12323328',
        	'address' => 'Sector Oeste, calle 2',
        	'email' => 'armandotorres@gmail.com',
        	'user_id' => 3
        ]);
        \DB::table('clients')->insert([
        	'name' => 'Marcos Blancos',
        	'rut' => '12323329',
        	'address' => 'Sector Oeste, calle 1',
            'phone' => '2121223232',
        	'email' => 'marcosblancos@gmail.com',
        	'user_id' => 3
        ]);
    }
}
