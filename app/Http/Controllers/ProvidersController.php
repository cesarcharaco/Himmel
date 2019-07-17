<?php

namespace App\Http\Controllers;

use App\Providers;
use App\User;
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
        if (\Auth::getUser()->user_type=="Admin") {
        $providers=Providers::all();
        } else {
        $providers=Providers::where('user_id',\Auth::getUser()->id)->get();
        }
        
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
        if (\Auth::getUser()->user_type=="Admin") {
            $users=User::where('user_type','<>','Admin')->get();
            return view('admin.providers.create',compact('users'));    
        } else {
            return view('admin.providers.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvidersRequest $request)
    {
        if (\Auth::getUser()->user_type=="Admin") {
            $user_id=$request->user_id;
        } else {
            $user_id=\Auth::getUser()->id;
        }
        
        $buscar=Providers::where('email',$request->email)->where('user_id',$user_id)->first();
        if (count($buscar)>0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este correo!')->warning()->important();
            return redirect()->back();
        } else {
            $buscar2=Providers::where('rut',$request->rut)->where('user_id',$user_id)->first();
            if (count($buscar2)>0) {
                flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este RUT!')->warning()->important();
                return redirect()->back();
            } else {
                $buscar3=Providers::where('business_name',$request->business_name)->where('user_id',$user_id)->first();
                if (count($buscar3)>0) {
                    flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este Nombre!')->warning()->important();
                    return redirect()->back();
                } else {
                    $provider=new Providers();

                    $provider->business_name=$request->business_name;
                    $provider->rut=$request->rut;
                    $provider->salesman=$request->salesman;
                    $provider->address=$request->address;
                    $provider->email=$request->email;
                    $provider->phone=$request->phone;
                    $provider->user_id=$user_id;
                    
                    
                    $provider->save();

                    flash('<i class="icon-circle-check"></i> Proveedor registrado con satisfactoriamente!')->success()->important();
                    return redirect()->to('providers');
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
        if (\Auth::getUser()->user_type=="Admin") {
            $user_id=$request->user_id;
        } else {
            $user_id=\Auth::getUser()->id;
        }
        $buscar=Providers::where('email',$request->email)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
        if (count($buscar)>0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este correo!')->warning()->important();
        } else {
            $buscar2=Providers::where('rut',$request->rut)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
            if (count($buscar2)>0) {
                flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este RUT!')->warning()->important();
            } else {
                $buscar3=Providers::where('business_name',$request->business_name)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
                if (count($buscar3)>0) {
                    flash('<i class="icon-circle-check"></i> Ya tiene un Proveedor registrado con este Nombre!')->warning()->important();
                } else {
                    $provider= Providers::find($id);

                    $provider->business_name=$request->business_name;
                    $provider->rut=$request->rut;
                    $provider->salesman=$request->salesman;
                    $provider->address=$request->address;
                    $provider->email=$request->email;
                    $provider->phone=$request->phone;
                    $provider->user_id=$user_id;
                    
                    $provider->save();

                    flash('<i class="icon-circle-check"></i> Proveedor actualizado con satisfactoriamente!')->success()->important();
                    return redirect()->to('providers');
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
        $provider=Providers::find($request->provider_id);

        if ($provider->delete()) {
            flash('Registro eliminado satisfactoriamente!', 'success');
                return redirect()->back();
        } else {
            flash('No se pudo eliminar el registro, posiblemente esté siendo usada su información en otra área!', 'error');
                return redirect()->back();
        }
    }
}
