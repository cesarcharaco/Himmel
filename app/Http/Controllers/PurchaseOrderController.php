<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use App\Providers;
use App\Products;
use App\User;
use App\FilesPurchaseOrder;
use Illuminate\Http\Request;

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
        
            $buscar=PurchaseOrder::all();
            $ultimo=$buscar->last();
            $purchase= new PurchaseOrder();
            $purchase->date=date('Y-m-d');
            $purchase->provider_id=$request->provider_id;
            $purchase->codex=date('Ymd')."-".$ultimo;
            $purchase->comments=$request->comments;
            $purchase->send_email=$request->send_email;
            $purchase->save();

            for ($i=0; $i < count($request->product_id) ; $i++) { 
                \DB::table('purchase_has_products')->insert([
                    'purchase_id' => $purchase->id,
                    'product_id' => $request->product_id[$i],
                    'amount' => $request->amount[$id]
                ]);
            }

        flash('<i class="icon-circle-check"></i> Orden de COmpra registrada exitosamente!')->success()->important();
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
}
