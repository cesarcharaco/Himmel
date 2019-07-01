<?php

namespace App\Http\Controllers;

use App\Quotations;
use Illuminate\Http\Request;
use App\Products;
use App\User;
use App\Clients;
use App\Files;

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
