<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PdfContent extends Model
{
    protected $table='pdf_content';

    protected $fillable=['user_id','image_name','url_image','page_foot'];

    public function users()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
