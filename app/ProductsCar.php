<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsCar extends Model
{
    protected $table='products_car';

    protected $fillable=['user_id','product_id','name','characteriscs','unity','price'];
}
