<?php

namespace App\Http\Controllers;

use App\Quotations;
use Illuminate\Http\Request;
use App\Products;
use App\User;
use App\Clients;
use App\Files;
use App\Mail\AdjuntarQuotation;
use App\PdfContent;
use Mail;
use PDF;
class QuotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations=Quotations::all();
        return view('admin.quotations.index',compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hoy=date('Y-m-d');
        if (\Auth::getUser()->user_type=="Admin") {
            $products=Products::all();
            $clients=Clients::all();
            $users=User::where('user_type','<>','Admin')->get();
           

            return view('admin.quotations.create',compact('products','clients','users','hoy'));
        } else {
            $products=Products::where('user_id',\Auth::getUser()->id)->get();
            $clients=Clients::where('user_id',\Auth::getUser()->id)->get();
           
            return view('admin.quotations.create',compact('products','clients','hoy'));
        }
        
        
    }

    public function search_clients($user_id)
    {
        return $clients=Clients::where('user_id',$user_id)->get();
    }

    public function search_products($user_id)
    {
        return $products=Products::where('user_id',$user_id)->get();
    }

    public function products_add($product_id)
    {
    
        return $products=Products::where('id',$product_id)->get(); 
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'files.*' => 'mimes:doc,pdf,docx,zip',
            'offer_validity' => 'date|required',
            'place_delivery' => 'required',
            'offer_validity' => 'date|required'
        ]);

        //--- buscando contenido de pdf
            $pdfcontent=PdfContent::where('user_id',$request->user_id)->first();
            
            //-----------
            
        if ($pdfcontent !== null) {
            $codigo=$this->generarCodigo();
           if (count($request->product_id)>0) {
                
            $codigo=$this->generarCodigo();
            if($request->hasfile('files')){

            foreach($request->file('files') as $file){

                $name=$file->getClientOriginalName();
                $file->move(public_path().'/files/', $name);  
                $names[] = $name;
                $urls[] ='files/'.$name;

            }

         }
            
            
            //dd($ultimo);
            $quotation= new Quotations();
            $quotation->client_id=$request->client_id;
            $quotation->codex=$codigo;
            $quotation->comments=$request->comments;
            $quotation->discount=$request->discount;
            $quotation->offer_validity=$request->offer_validity;
            $quotation->time_delivery=$request->time_delivery;
            $quotation->place_delivery=$request->place_delivery;
            $quotation->delivery_term=$request->delivery_term;
            $quotation->way_pay=$request->way_pay;
            $quotation->coin=$request->coin;
            $quotation->address_to=$request->address_to;
            $quotation->email_comments=$request->email_comments;
            $quotation->save();
            
            if(isset($names)){  
                
                for ($i=0; $i <count($names) ; $i++) { 
                    $myfiles= new Files();
                    $myfiles->quotation_id = $quotation->id;
                    $myfiles->name_file = $names[$i];
                    $myfiles->url_file = $urls[$i];
                    $myfiles->save();
                }
            }

            for ($i=0; $i < count($request->product_id) ; $i++) { 
                \DB::table('quotations_has_products')->insert([
                    'quotation_id' => $quotation->id,
                    'product_id' => $request->product_id[$i],
                    'amount' => $request->amount[$i]
                ]);
            }
            
        //generando pdf de la orden de compra

                 $pdf = PDF::loadView('admin.pdfs.quotation', compact('quotation','pdfcontent'));
                    $salida=$pdf->output();
                    $name='Cotización -'.$codigo.'.pdf';
                    $ruta=public_path().'/FilesQuotations/'.$name;
                    //---- registrando archivo
                    $myfiles= new Files();
                    $myfiles->quotation_id = $quotation->id;
                    $myfiles->name_file = $name;
                    $myfiles->url_file = 'FilesQuotations/'.$name;
                    $myfiles->save();
                    //----------------------------
                    file_put_contents($ruta, $salida);
            //----------------
        $client=Clients::find($request->client_id);
            Mail::to($client->email)->send(new AdjuntarQuotation($quotation->id)); 

        flash('<i class="icon-circle-check"></i> Cotización registrada exitosamente!')->success()->important();
            return redirect()->to('quotations');
            } else {
                flash('<i class="icon-circle-check"></i> No se ha seleccionado ningún producto!')->warning()->important();
            return redirect()->back();
            }
        } else {
            flash('<i class="icon-circle-check"></i> No se ha podido generar la Cotización ya que el usuario no ha registrado contenido para los Archivos que generará!')->warning()->important();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotations  $quotations
     * @return \Illuminate\Http\Response
     */
    public function show(Quotations $quotations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotations  $quotations
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotations $quotations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotations  $quotations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotations $quotations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotations  $quotations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->all());
        $quotation=Quotations::find($request->quotation_id);
        foreach ($quotation->files as $key) {
            
            unlink(public_path().'/'.$key->url_file);
        }
        if ($quotation->delete()) {
            flash('<i class="icon-circle-check"></i> Cotización eliminada exitosamente!')->success()->important();
            return redirect()->back();           
        } else {
            flash('<i class="icon-circle-check"></i> No se ha podido eliminar la Cotización!')->warning()->important();
            return redirect()->back();
        }
        

    }
    protected function generarCodigo() {
     $key = '';
     $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $max = strlen($pattern)-1;
     for($i=0;$i < 4;$i++) $key .= $pattern{mt_rand(0,$max)};
     return $key;
    }

    public function watch($quotation_id)
    {
        //dd($quotation_id);
        $quotation=Quotations::find($quotation_id);
        
        //dd($quotation->clients->user_id);
        $pdfcontent=PdfContent::where('user_id',$quotation->clients->user_id)->first();
        $pdf = PDF::loadView('admin.pdfs.quotation', array('pdfcontent'=>$pdfcontent, 'quotation'=>$quotation));
        

            return $pdf->stream('Cotizacion.pdf');
    }
}
