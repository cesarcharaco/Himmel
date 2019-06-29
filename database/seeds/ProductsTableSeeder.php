<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->insert([
        	'name' => 'Cinta Indicadora',
        	'characteriscs' => 'para esterilización a vapor húmedo, rollo de 1/2" o 3/4" x 25-60 Yardas',
        	'existence' => 100,
        	'unity' => 'Individual',
        	'price' => '100',
        	'stock_min' => '10',
        	'stock_max' => '100',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 1,
            'cost' => 80
        ]);

        \DB::table('products')->insert([
        	'name' => 'Gabacha Hospitalaria',
        	'characteriscs' => ' talla S, descartable, empaque individual estéril',
        	'existence' => 100,
        	'unity' => 'Individual',
        	'price' => '10',
        	'stock_min' => '100',
        	'stock_max' => '1000',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 2,
            'cost' => 8
        ]);
        \DB::table('products')->insert([
        	'name' => 'Gabacha Hospitalaria',
        	'characteriscs' => ' talla S, descartable, empaque individual estéril',
        	'existence' => 100,
        	'unity' => 'Caja',
        	'price' => '100',
        	'stock_min' => '10',
        	'stock_max' => '100',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 3,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
        	'name' => 'Guantes Quirúrgicos',
        	'characteriscs' => ' de látex Nº 6 ½, estéril descartable, par',
        	'existence' => 100,
        	'unity' => 'Individual',
        	'price' => '10',
        	'stock_min' => '100',
        	'stock_max' => '1000',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 4,
            'cost' => 8
        ]);
        \DB::table('products')->insert([
        	'name' => 'Guantes Quirúrgicos',
        	'characteriscs' => ' de látex Nº 6 ½, estéril descartable, par',
        	'existence' => 100,
        	'unity' => 'Caja',
        	'price' => '100',
        	'stock_min' => '10',
        	'stock_max' => '100',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 5,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
        	'name' => 'Guantes Quirúrgicos',
        	'characteriscs' => 'de látex Nº 7, estéril descartable, par',
        	'existence' => 100,
        	'unity' => 'Caja',
        	'price' => '100',
        	'stock_min' => '10',
        	'stock_max' => '100',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 6,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
        	'name' => 'PINZA DENTAL MERIAM',
        	'characteriscs' => ' para algodón y curación, bordes redondeados, parte activa con superficie interna estriada, de acero inoxidable',
        	'existence' => 100,
        	'unity' => 'Individual',
        	'price' => '100',
        	'stock_min' => '10',
        	'stock_max' => '100',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 7,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
        	'name' => 'PINZA RECTA FORESTER',
        	'characteriscs' => ' porta instrumentos de 25 cm a 30cm, parte activa en forma de anillo con superficie interna estriada y amplia, de acero inoxidable',
        	'existence' => 100,
        	'unity' => 'Individual',
        	'price' => '100',
        	'stock_min' => '10',
        	'stock_max' => '100',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 8,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
        	'name' => 'MERCURIO METALICO',
        	'characteriscs' => ' químicamente puro, uso dental, frasco de ¼ lb',
        	'existence' => 100,
        	'unity' => 'Individual',
        	'price' => '100',
        	'stock_min' => '10',
        	'stock_max' => '100',
        	'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 1,
            'product_id' => 9,
            'cost' => 80
        ]);
        //--------------------- maeriales de construccion usuario 2
        \DB::table('products')->insert([
            'name' => 'Cemento',
            'characteriscs' => 'Para realizar concreto',
            'existence' => 100,
            'unity' => 'Saco',
            'price' => '300',
            'stock_min' => '10',
            'stock_max' => '100',
            'user_id' => 3
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 10,
            'cost' => 250
        ]);
        \DB::table('products')->insert([
            'name' => 'Arena Común',
            'characteriscs' => 'Para realizar concreto',
            'existence' => 100,
            'unity' => 'M3',
            'price' => '15',
            'stock_min' => '100',
            'stock_max' => '1000',
            'user_id' => 3
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 11,
            'cost' => 10
        ]);
        \DB::table('products')->insert([
            'name' => 'Gabacha Hospitalaria',
            'characteriscs' => ' talla S, descartable, empaque individual estéril',
            'existence' => 100,
            'unity' => 'Caja',
            'price' => '100',
            'stock_min' => '10',
            'stock_max' => '100',
            'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 12,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
            'name' => 'Verenga',
            'characteriscs' => '2x4 pgdas',
            'existence' => 100,
            'unity' => 'Caja',
            'price' => '2',
            'stock_min' => '100',
            'stock_max' => '1000',
            'user_id' => 3
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 13,
            'cost' => 0.7
        ]);
        \DB::table('products')->insert([
            'name' => 'Guantes Quirúrgicos',
            'characteriscs' => ' de látex Nº 6 ½, estéril descartable, par',
            'existence' => 100,
            'unity' => 'Caja',
            'price' => '100',
            'stock_min' => '10',
            'stock_max' => '100',
            'user_id' => 2
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 14,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
            'name' => 'Clavos',
            'characteriscs' => 'Acero 3 pgds',
            'existence' => 10,
            'unity' => 'Kilo',
            'price' => '10',
            'stock_min' => '10',
            'stock_max' => '100',
            'user_id' => 3
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 15,
            'cost' => 8
        ]);
        \DB::table('products')->insert([
            'name' => 'Tubo',
            'characteriscs' => 'PCV Sanitario 4 pgds',
            'existence' => 100,
            'unity' => 'Paquete',
            'price' => '100',
            'stock_min' => '10',
            'stock_max' => '100',
            'user_id' => 3
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 16,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
            'name' => 'Tubo',
            'characteriscs' => 'PCV Sanitario 3 pgds',
            'existence' => 100,
            'unity' => 'Paquete',
            'price' => '100',
            'stock_min' => '10',
            'stock_max' => '100',
            'user_id' => 3
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 17,
            'cost' => 80
        ]);
        \DB::table('products')->insert([
            'name' => 'Amarras',
            'characteriscs' => 'material de nailon, 1/4 pgds',
            'existence' => 100,
            'unity' => 'Kilo',
            'price' => '100',
            'stock_min' => '10',
            'stock_max' => '100',
            'user_id' => 3
        ]);
        \DB::table('providers_has_products')->insert([
            'provider_id' => 2,
            'product_id' => 18,
            'cost' => 80
        ]);
    }
}
