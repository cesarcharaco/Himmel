<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\Providers;
use App\Products;
use App\User;
use App\FilesPurchaseOrder;
use Illuminate\Http\Request;
use Mail;
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
            'files.*' => 'mimes:doc,pdf,docx,zip'
        ]);

        if($request->hasfile('files')){

            foreach($request->file('files') as $file){

                $name=$file->getClientOriginalName();
                $file->move(public_path().'/files/', $name);  
                $names[] = $name;
                $urls[] = public_path().'/files/'.$name;

            }

         }
            
            
            $codigo=$this->generarCodigo();
            //dd($ultimo);
            $purchase= new PurchaseOrder();
            $purchase->date=date('Y-m-d');
            $purchase->provider_id=$request->provider_id;
            $purchase->codex=date('Ymd')."-".$codigo;
            $purchase->comments=$request->comments;
            $purchase->send_email=$request->send_email;
            $purchase->save();
            if(!isset($data)){  
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
             $pdf = PDF::loadView('pdf.curriculo', compact('usuario'));
                $salida=$pdf->output();
                $ruta='C:/xampp/htdocs/bolsa/public/descargas/'.'Curriculo de '.$usuario->name." ".$usuario->second_name.'.pdf';
                file_put_contents($ruta, $salida);
            //----------------
         Mail::to($request->send_email)->send(new Adjuntar($purchase->id)); // Se ha conseguido que los PDF se creen y se ha conseguido enviar el email. Solo queda que los emails se adjunte.
            return back()->with('message',['success','Se ha enviado a la empresa un email con el PDF adjunto.']);
        }






        flash('<i class="icon-circle-check"></i> Orden de Compra registrada exitosamente!')->success()->important();
            return redirect()->to('purchaseorders');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
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
     $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
     $max = strlen($pattern)-1;
     for($i=0;$i < 4;$i++) $key .= $pattern{mt_rand(0,$max)};
     return $key;
    }
}
