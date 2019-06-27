<?php

namespace App\Http\Controllers;

use App\Providers;
use Illuminate\Http\Request;
use App\Http\Requests\ProvidersRequest;
class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers=Providers::all();
        $cont=count($providers);

        return view('admin.providers.index',compact('providers','cont'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvidersRequest $request)
    {
        $buscar=Providers::where('email',$request->email)->where('user_id',\Auth::getUser()->id)->first();
        if (count($buscar)>0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este correo!')->warning()->important();
        } else {
            $buscar2=Providers::where('rif',$request->rif)->where('user_id',\Auth::getUser()->id)->first();
            if (count($buscar2)>0) {
                flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este RIF!')->warning()->important();
            } else {
                $buscar3=Providers::where('business_name',$request->business_name)->where('user_id',\Auth::getUser()->id)->first();
                if (count($buscar3)>0) {
                    flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este Nombre!')->warning()->important();
                } else {
                    $provider=new Providers();

                    $provider->business_name=$request->business_name;
                    $provider->letter=$request->letter;
                    $provider->rif=$request->rif;
                    $provider->salesman=$request->salesman;
                    $provider->address=$request->address;
                    $provider->email=$request->email;
                    $provider->phone=$request->phone;
                    $provider->user_id=\Auth::getUser()->id;
                    $provider->save();

                    flash('<i class="icon-circle-check"></i> Proveedor registrado con satisfactoriamente!')->success()->important();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function show(Providers $providers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider=Providers::find($id);

        return view('admin.providers.edit',compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function update(ProvidersRequest $request, $id)
    {
        $buscar=Providers::where('email',$request->email)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
        if (count($buscar)>0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este correo!')->warning()->important();
        } else {
            $buscar2=Providers::where('rif',$request->rif)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
            if (count($buscar2)>0) {
                flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este RIF!')->warning()->important();
            } else {
                $buscar3=Providers::where('business_name',$request->business_name)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
                if (count($buscar3)>0) {
                    flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este Nombre!')->warning()->important();
                } else {
                    $provider= Providers::find($id);

                    $provider->business_name=$request->business_name;
                    $provider->letter=$request->letter;
                    $provider->rif=$request->rif;
                    $provider->salesman=$request->salesman;
                    $provider->address=$request->address;
                    $provider->email=$request->email;
                    $provider->phone=$request->phone;
                    $provider->save();

                    flash('<i class="icon-circle-check"></i> Proveedor actualizado con satisfactoriamente!')->success()->important();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Providers  $providers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $provider=Providers::find($request->id_client);

        if ($provider->delete()) {
            flash('Registro eliminado satisfactoriamente!', 'success');
                return redirect()->back();
        } else {
            flash('No se pudo eliminar el registro, posiblemente esté siendo usada su información en otra área!', 'error');
                return redirect()->back();
        }
    }
}
