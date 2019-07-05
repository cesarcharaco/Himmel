<?php

use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('providers')->insert([
        	'business_name' => 'OdontoClinics YAEL C.A'
        	,'rut' => '12323371',
        	'salesman' => 'Javier Romero',
        	'address' => '5ta Av. Amazonas Edificio Vertical pisos 1-2-3',
        	'email' => 'odontoclinics.yael@gmail.com',
        	'phone' => '56 000 000 00',
        	'user_id' => 2
        ]);

        \DB::table('providers')->insert([
        	'business_name' => 'Babel Construct C.A'
        	,'rut' => '12323372',
        	'salesman' => 'Martin Labrador',
        	'address' => 'Sector Mamporal, Av. Martin',
        	'email' => 'babel.construc@gmail.com',
        	'phone' => '56 000 000 01',
        	'user_id' => 3
        ]);
    }
}
