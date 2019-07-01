<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotations extends Model
{
    protected $table='quotations';

    protected $fillable=['client_id','comments','discount','offer_validity','place_delivery','delivery_term','way_pay','coin','address_to','email_comments'];

    public function clients()
    {
    	return $this->belongsTo('App\Clients','client_id');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Products','quotations_has_products','quotation_id','product_id')->withPivot('amount');
    }

    public function files()
    {
    	return $this->hasMany('App\Files','quotation_id','id');
    }
}
