<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Files;
use App\Quotations;

class AdjuntarQuotation extends Mailable{
    use Queueable, SerializesModels;
    public $sector;

    public function __construct($sector){
        $this->sector=$sector;
    }

    public function build(){
        ini_set('max_execution_time', 360); //3 minutes 
        $quotation=Quotations::find($this->sector);
         $email = $this->view('admin.quotations.mesagges_quotation',compact('quotation'))->subject('Cotización');

	    // $archivosadjuntos es una matriz con rutas de archivos de archivos adjuntos
         $archivosadjuntos = Files::where('quotation_id',$this->sector)->get();
	    foreach($archivosadjuntos as $rutaArchivo){
	        $email->attach(public_path().'/'.$rutaArchivo->url_file);
	    }
	    return $email;
    }
}