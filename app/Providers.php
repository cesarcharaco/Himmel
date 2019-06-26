<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    protected $table='providers';

    protected $fillable=['business_name','letter','rif','salesman','address','email','phone','user_id'];

    public function users()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function purchaseorders()
    {
    	return $this->hasMany('App\PurchaseOrder','provider_id','id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Products','providers_has_products','provider_id','product_id')->withPivot('cost');
    }
}
