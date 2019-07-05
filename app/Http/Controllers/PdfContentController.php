<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PdfContent;
use App\User;
class PdfContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::getUser()->user_type=="Admin") {
            $pdfcontent=PdfContent::all();
        } else {
            $pdfcontent=PdfContent::where('user_id',\Auth::getUser()->id)->get();
        }
        
        return view('admin.pdfcontent.index',compact('pdfcontent'));
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
            return view('admin.pdfcontent.create',compact('users'));
        } else {
            $buscar=PdfContent::where('user_id',\Auth::getUser()->id)->get();
            if ($buscar !== null) {
                flash('<i class="icon-circle-check"></i> Ya existe un registro del Contenido de PDF, para registrar uno debe eliminar el anterior!')->success()->important();
                return redirect()->back();
            } else {
                return view('admin.pdfcontent.create');
            }
            
            
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
            'image' => 'required',
            'image.*' => 'mimes:jpeg,jpg,png',
            'page_foot' => 'required'
        ]);

        $name=$request->file('image')->getClientOriginalName();
        $request->file('image')->move('/images/', $name);  
        $url = '/images/'.$name;

        $pdfcontent=new PdfContent();
        $pdfcontent->user_id=$request->user_id;
        $pdfcontent->image_name=$name;
        $pdfcontent->url_image=$url;
        $pdfcontent->page_foot=$request->page_foot;
        $pdfcontent->save();

        flash('<i class="icon-circle-check"></i> Contenido de PDF registrado exitosamente!')->success()->important();
            return redirect()->to('pdfcontent');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
