<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table='purchase_order';

    protected $fillable=['date','provider_id','codex','status','comments','send_email'];

    public function providers()
    {
    	return $this->belongsTo('App\Providers','provider_id');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Products','purchase_has_products','purchase_id','product_id')->withPivot('amount');
    }

    public function files()
    {
        return $this->hasMany('App\FilesPurchaseOrder','purchase_id','id');
    }

}
