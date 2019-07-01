<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilesPurchaseOrder extends Model
{
    protected $table='purchaseorders_has_files';

    protected $fillable=['purchase_id','url_file'];

    public function purchaseorders()
    {
    	return $this->belongsTo('App\PurchasOrder','purchase_id');
    }

}
