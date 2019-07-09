<?php

use Illuminate\Database\Seeder;

class PdfContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pdf_content')->insert([
        	'user_id' => 2,
        	'image_name' => 'cintillo.png',
        	'url_image' => '/images/cintillo.png',
        	'page_foot' => 'XXXXXXXXX XXXXXXXXX xxxxxxxxx xxxxxxxxxxxxx xxxxxxxxxxxx xxxxxxxxxxxxxx xxxxxxx 0000000901100000',
        	'created_at' => '2019-07-09 03:28:51'
        ]);
    }
}
