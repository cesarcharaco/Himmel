<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\FilesPurchaseOrder;
class Adjuntar extends Mailable{
    use Queueable, SerializesModels;
    public $sector;

    public function __construct($sector){
        $this->sector=$sector;
    }

    public function build(){
         $email = $this->view('correo.adjunto')->subject('Curriculum');

	    // $archivosadjuntos es una matriz con rutas de archivos de archivos adjuntos
         $archivosadjuntos = new FilesPurchaseOrder::where('purchase_id',$this->sector)->get();
	    foreach($archivosadjuntos as $rutaArchivo){
	        $email->attach($rutaArchivo);
	    }
	    return $email;
    }
}