<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;
use App\Http\Requests\ClientsRequest;
class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=Clients::all();
        $cont=count($clients);

        return view('admin.clients.index',compact('clients','cont'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientsRequest $request)
    {
        $buscar=Clients::where('email',$request->email)->where('user_id',\Auth::getUser()->id)->first();
        if (count($buscar)>0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un Cliente registrado con este correo!')->warning()->important();
        } else {
            $buscar2=Clients::where('rif',$request->rif)->where('user_id',\Auth::getUser()->id)->first();
            if (count($buscar2)>0) {
                flash('<i class="icon-circle-check"></i> Ya tiene un Cliente registrado con este RIF!')->warning()->important();
            } else {
                $client=new Clients();

                $client->name=$request->name;
                $client->letter=$request->letter;
                $client->rif=$request->rif;
                $client->address=$request->address;
                $client->phone=$request->phone;
                $client->user_id=\Auth::getUser()->id;
                $client->save();

                flash('<i class="icon-circle-check"></i> Cliente registrado con satisfactoriamente!')->success()->important();
            }
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $clients)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client=Clients::find($id);

        return view('admin.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(ClientsRequest $request, $id)
    {
        $buscar=Clients::where('email',$request->email)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
        if (count($buscar)>0) {
            flash('<i class="icon-circle-check"></i> Ya tiene un cliente registrado con este correo!')->warning()->important();
        } else {
            $buscar2=Clients::where('rif',$request->rif)->where('user_id',\Auth::getUser()->id)->where('id','<>',$id)->first();
            if (count($buscar2)>0) {
                flash('<i class="icon-circle-check"></i> Ya tiene un cliente registrado con este RIF!')->warning()->important();
            } else {
                $client= Clients::find($id);

                $client->name=$request->name;
                $client->letter=$request->letter;
                $client->letter=$request->rif;
                $client->address=$request->address;
                $client->phone=$request->phone;
                $client->save();

                flash('<i class="icon-circle-check"></i> Cliente actualizado con satisfactoriamente!')->success()->important();
            }
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $client=Clients::find($request->id_client);

        if ($client->delete()) {
            flash('Registro eliminado satisfactoriamente!', 'success');
                return redirect()->back();
        } else {
            flash('No se pudo eliminar el registro, posiblemente esté siendo usada su información en otra área!', 'error');
                return redirect()->back();
        }
    }
}
