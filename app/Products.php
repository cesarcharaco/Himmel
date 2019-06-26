<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table='products';

    protected $fillable=['name','characteriscs','existence','unity','price_ind','price_und','stock_min','stock_max','user_id'];


    public function users()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function purchaseorder()
    {
    	return $this->belongsToMany('App\PurchaseOrder','purchase_has_products','product_id','purchase_id')->withPivot('amount');
    }

    public function requestsorders()
    {
        return $this->belongsToMany('App\RequestsOrder','requests_has_products','product_id','request_id')->withPivot('amount');
    }

    public function products()
    {
        return $this->belongsToMany('App\Quotations','quotations_has_products','product_id','quotation_id')->withPivot('amount');
    }

    public function providers()
    {
        return $this->belongsToMany('App\Providers','providers_has_products','product_id','provider_id')->withPivot('cost');
    }    
}
