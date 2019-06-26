<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table='clients';

    protected $fillable=['name','letter','rif','address','email','user_id'];

    public function quotations()
    {
    	return $this->hasMany('App\Quotations','client_id','id');
    }

    public function users()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
