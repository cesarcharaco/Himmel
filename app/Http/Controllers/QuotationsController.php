<?php

namespace App\Http\Controllers;

use App\Quotations;
use Illuminate\Http\Request;
use App\Products;
use App\User;
use App\Clients;
use App\Files;
use App\ProductsCar;
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
        if (\Auth::getUser()->user_type=="Admin") {
            $products=Products::all();
            $clients=Clients::all();
            $users=User::where('user_type','<>','Admin')->get();
            $car=ProductsCar::all();

            return view('admin.quotations.create',compact('products','clients','users','car'));
        } else {
            $products=Products::where('user_id',\Auth::getUser()->id)->get();
            $clients=Clients::where('user_id',\Auth::getUser()->id)->get();
            $car=ProductsCar::where('user_id',\Auth::getUser()->id)->get();
            return view('admin.quotations.create',compact('products','clients','car'));
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
        $product=Products::find($product_id);
        $buscar=ProductsCar::where('user_id',$product->user_id)->where('product_id',$product_id)->first();
        if (count($buscar)==0) {
            $car=new ProductsCar();
            $car->user_id=$product->user_id;
            $car->product_id=$product_id;
            $car->name=$product->name;
            $car->characteriscs=$product->characteriscs;
            $car->unity=$product->unity;
            $car->price=$product->price;
            $car->save();
             return $products=ProductsCar::where('product_id',$product_id)->get();
        } else {
            return $products=ProductsCar::where('id',0)->get();;
        }
        
    }

    public function product_delete($product_id)
    {
        $buscar=ProductsCar::where('user_id',$product->user_id)->where('product_id',$product_id)->first();
        $user_id=$buscar->user_id;
        $buscar->delete();

        return $products=ProductsCar::where('user_id',$user_id)->get();

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Quotations $quotations)
    {
        //
    }
}
