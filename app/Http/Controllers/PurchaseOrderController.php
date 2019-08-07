<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\Providers;
use App\Products;
use App\User;
use App\FilesPurchaseOrder;
use App\PdfContent;
use App\Mail\Adjuntar;
use Illuminate\Http\Request;
use Mail;
use PDF;
class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseorders=PurchaseOrder::all();

        return view('admin.purchaseorders.index',compact('purchaseorders'));
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
            $providers=Providers::all();
            $users=User::where('user_type','<>','Admin')->get();
           

            return view('admin.purchaseorders.create',compact('products','providers','users','hoy'));
        } else {
            $products=Products::where('user_id',\Auth::getUser()->id)->get();
            $providers=Providers::where('user_id',\Auth::getUser()->id)->get();
           
            return view('admin.purchaseorders.create',compact('products','providers','hoy'));
        }
        
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
            'send_email' => 'email|required'
        ]);

        //--- buscando contenido de pdf
            $pdfcontent=PdfContent::where('user_id',$request->user_id)->first();
            
            //-----------
        if ($pdfcontent !== null) {
            
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
            $purchase= new PurchaseOrder();
            $purchase->date=date('Y-m-d');
            $purchase->provider_id=$request->provider_id;
            $purchase->codex=date('Ymd')."-".$codigo;
            $purchase->comments=$request->comments;
            $purchase->send_email=$request->send_email;
            $purchase->save();
            
            if(isset($names)){  
                
                for ($i=0; $i <count($names) ; $i++) { 
                    $myfiles= new FilesPurchaseOrder();
                    $myfiles->purchase_id = $purchase->id;
                    $myfiles->name_file = $names[$i];
                    $myfiles->url_file = $urls[$i];
                    $myfiles->save();
                }
            }

            for ($i=0; $i < count($request->product_id) ; $i++) { 
                \DB::table('purchase_has_products')->insert([
                    'purchase_id' => $purchase->id,
                    'product_id' => $request->product_id[$i],
                    'amount' => $request->amount[$i]
                ]);
            }
            
        //generando pdf de la orden de compra

                 $pdf = PDF::loadView('admin.pdfs.purchase_order', compact('purchase','pdfcontent'));
                    $salida=$pdf->output();
                    $name='Orden de Compra '.$purchase->codex.'.pdf';
                    $ruta=public_path().'/FilesPurchaseOrders/'.$name;
                    //---- registrando archivo
                    $myfiles= new FilesPurchaseOrder();
                    $myfiles->purchase_id = $purchase->id;
                    $myfiles->name_file = $name;
                    $myfiles->url_file = 'FilesPurchaseOrders/'.$name;
                    $myfiles->save();
                    //----------------------------
                    file_put_contents($ruta, $salida);
            //----------------
            
        flash('<i class="icon-circle-check"></i> Orden de Compra registrada exitosamente!')->success()->important();
            return redirect()->to('purchaseorders');

        } else {
            flash('<i class="icon-circle-check"></i> No se ha podido generar la Orden de Compra ya que el usuario no ha registrado contenido para los Archivos que generará!')->warning()->important();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    protected function generarCodigo() {
     $key = '';
     $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $max = strlen($pattern)-1;
     for($i=0;$i < 4;$i++) $key .= $pattern{mt_rand(0,$max)};
     return $key;
    }

    public function approve(Request $request)
    {
        $purchase=PurchaseOrder::find($request->purchase_id);
        $purchase->status="Aprobada";
        $purchase->save();
        Mail::to($purchase->send_email)->send(new Adjuntar($purchase->id)); 
        Mail::to($purchase->providers->email)->send(new Adjuntar($purchase->id));
        flash('<i class="icon-circle-check"></i> Orden de Compra APROBADA exitosamente y enviada al correo electrónico!')->success()->important();
            return redirect()->to('purchaseorders');


    }

    public function watch($purchase_id)
    {
        $purchase=PurchaseOrder::find($purchase_id);
        

        $pdfcontent=PdfContent::where('user_id',$purchase->providers->user_id)->first();
        $pdf = PDF::loadView('admin.pdfs.purchase_order', array('pdfcontent'=>$pdfcontent, 'purchase'=>$purchase));
        

            return $pdf->stream('Orden_de_Compra.pdf');
    }

    public function cancel(Request $request)
    {
        $purchase=PurchaseOrder::find($request->purchase_id);
        $purchase->status="Cancelada";
        $purchase->save();

        flash('<i class="icon-circle-check"></i> Orden de Compra CANCELADA exitosamente!')->success()->important();
            return redirect()->to('purchaseorders');        
    }
}
