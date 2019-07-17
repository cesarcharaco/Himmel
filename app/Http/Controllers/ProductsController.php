<?php

namespace App\Http\Controllers;

use App\Products;
use App\Providers;
use App\User;
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
        if (\Auth::getUser()->user_type=="Admin") {
            $products= Products::all();
        } else {
            $products= Products::where('user_id',\Auth::getUser()->id)->get();
        }
        
        
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
        if (\Auth::getUser()->user_type=="Admin") {
            $providers=Providers::all();
            $users=User::where('user_type','<>','Admin')->get();
            return view('admin.products.create',compact('providers','users'));
        } else {
            $providers=Providers::where('user_id',\Auth::getUser()->id)->get();
            return view('admin.products.create',compact('providers'));
        }
        
        
        //dd($providers);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        
        $buscar=Products::where('name',$request->name)->where('unity',$request->unity)->where('user_id',$request->user_id)->first();

        if ($buscar !== null && count($buscar) > 0) {

            flash('<i class="icon-circle-check"></i> Ya tiene un producto registrado con este nombre y unidad de medida!')->warning()->important();
            return redirect()->to('products/create');

        } else {

                if ( count($request->provider_id) > 0) 
                {
                    $product=new Products();
                    $product->user_id = $request->user_id;
                    $product->fill($request->except('user_id'))->save();

                    foreach ($request->provider_id as $key => $provider) 
                    {
                        $product->providers()->attach($provider, ['cost' => $request->cost[$key]]);
                    }
                    flash('<i class="icon-circle-check"></i> Producto registrado con satisfactoriamente!')->success()->important();
                    return redirect()->to('products/create');
                }else{
                    flash('<i class="icon-circle-check"></i> No ha seleccionado ningún proveedor!')->warning()->important();
                    return redirect()->back();
                }

                
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
        //dd($product->user_id);
        if (\Auth::getUser()->user_type=="Admin") {
            $providers=Providers::where('user_id',$product->user_id)->get();
        } else {
            $providers=Providers::where('user_id',\Auth::getUser()->id)->get();
        }
        
        
        return view('admin.products.edit',compact('product','providers'));
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
        if ($buscar !== null && count($buscar) > 0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un producto registrado con este nombre y unidad de medida!')->warning()->important();
        } else {
                $cont=0;
                $product= Products::find($id);

                if (count($request->provider_id) > 0) 
                {
                    foreach ($product->providers as $key => $provider) {
                        for ($i=0; $i < count($request->provider_id); $i++) { 
                            if ($provider->pivot->provider_id==$request->provider_id[$i]) {
                                $cont++;
                            }
                        }
                    }

                    if ($cont>0) {
                    flash('<i class="icon-circle-check"></i> Ha seleccionado uno o varios proveedores ya registrados!')->warning()->important();
                    return redirect()->back();
                    } else {
                        $product= Products::find($id);
                        
                        $product->fill($request->except('user_id'))->save();

                            foreach ($request->provider_id as $key => $provider) 
                            {
                                $product->providers()->attach($provider, ['cost' => $request->cost[$key]]);
                            }
                        

                        flash('<i class="icon-circle-check"></i> Producto Actualizado con satisfactoriamente!')->success()->important();
                        return redirect()->to('products');
                    }
                    
                }else{
                    flash('<i class="icon-circle-check"></i> No ha seleccionado ningún proveedor!')->warning()->important();
                    return redirect()->back();
                }
                //dd($cont);
                /*$product->name=$request->name;
                $product->characteriscs=$request->characteriscs;
                $product->existence=$request->existence;
                $product->unity=$request->unity;
                $product->price=$request->price;
                $product->stock_min=$request->stock_min;
                $product->stock_max=$request->stock_max;
                $product->save();
*/
                
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
        $product=Products::find($request->product_id);

        if ($product->delete()) {
            flash('Registro eliminado satisfactoriamente!', 'success');
                return redirect()->back();
        } else {
            flash('No se pudo eliminar el registro, posiblemente esté siendo usada su información en otra área!', 'error');
                return redirect()->back();
        }
    }

    public function delete_provider(Request $request)
    {
        //dd($request->all());
        $delete=\DB::table('providers_has_products')->where('product_id',$request->product_id)->where('provider_id',$request->provider_id)->delete();
        return redirect()->to('products/'.$request->product_id.'/edit');
    }

    public function providers_search($user_id)
    {
        return $providers=Providers::where('user_id',$user_id)->get();
    }
}
