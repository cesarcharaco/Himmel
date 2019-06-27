<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Products::all();
        $cont=count($products);
        return view('admin.products.index',compact('products','cont'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        $buscar=Products::where('name',$request->name)->where('unity',$request->unity)->where('user_id',\Auth::getUser()->id)->first();
        if (count($buscar)>0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un producto registrado con este nombre y unidad de medida!')->warning()->important();
        } else {
        
                $product=new Products();

                $product->name=$request->name;
                $product->characteriscs=$request->characteriscs;
                $product->existence=$request->existence;
                $product->unity=$request->unity;
                $product->price=$request->price;
                $product->stock_min=$request->stock_min;
                $product->stock_max=$request->stock_max;
                $product->user_id=\Auth::getUser()->id;
                $product->save();

                flash('<i class="icon-circle-check"></i> Producto registrado con satisfactoriamente!')->success()->important();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Products::find($id);

        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, $id)
    {
        $buscar=Products::where('name',$request->name)->where('unity',$request->unity)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
        if (count($buscar)>0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un producto registrado con este nombre y unidad de medida!')->warning()->important();
        } else {
        
                $product= Products::find($id);

                $product->name=$request->name;
                $product->characteriscs=$request->characteriscs;
                $product->existence=$request->existence;
                $product->unity=$request->unity;
                $product->price=$request->price;
                $product->stock_min=$request->stock_min;
                $product->stock_max=$request->stock_max;
                $product->save();

                flash('<i class="icon-circle-check"></i> Producto actualizado con satisfactoriamente!')->success()->important();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product=Products::find($request->id_product);

        if ($product->delete()) {
            flash('Registro eliminado satisfactoriamente!', 'success');
                return redirect()->back();
        } else {
            flash('No se pudo eliminar el registro, posiblemente esté siendo usada su información en otra área!', 'error');
                return redirect()->back();
        }
    }
}
