<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestsOrder extends Model
{
    protected $table='requests_order';

    protected $fillable=['date','codex','status'];

    public function products()
    {
        return $this->belongsToMany('App\Products','requests_has_products','request_id','product_id')->withPivot('amount');
    }
}
