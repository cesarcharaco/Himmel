<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\FilesPurchaseOrder;
use App\PurchaseOrder;

class Adjuntar extends Mailable{
    use Queueable, SerializesModels;
    public $sector;

    public function __construct($sector){
        $this->sector=$sector;
    }

    public function build(){
        ini_set('max_execution_time', 360); //3 minutes 
        $purchaseorders=PurchaseOrder::all();
         $email = $this->view('admin.purchaseorders.index',compact('purchaseorders'))->subject('Orden de Compra');

	    // $archivosadjuntos es una matriz con rutas de archivos de archivos adjuntos
         $archivosadjuntos = FilesPurchaseOrder::where('purchase_id',$this->sector)->get();
	    foreach($archivosadjuntos as $rutaArchivo){
	        $email->attach(public_path().'/'.$rutaArchivo->url_file);
	    }
	    return $email;
    }
}