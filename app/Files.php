<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table='quotations_has_files';

    protected $fillable=['quotation_id','url_file'];

    public function quotations()
    {
    	return $this->belongsTo('App\Quotations','quotation_id');
    }

    
}
