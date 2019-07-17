@extends('admin.index')

@section('sub-title')
<title>Himmel! | Registar Contenido de PDF</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Contenido de PDF</h4>
                
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contenido de PDF</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    @include('flash::message')
     @if (count($errors) > 0)
        <div class="alert alert-danger">
        @include('flash::message')
        <p>Corrige los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        </div>
    @endif
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
            <div class="card">
                <form class="form-horizontal" method="POST" action="{{ route('pdfcontent.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Registrar Contenido de PDF <br> <p>Todos los campos son requeridos (<b style="color:red;">*</b>)</p></h4>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="name"> <b style="color:red;">*</b>Imagen de Encabezado:</label>
                                <input type="file" class="form-control"  name="image" id="image">
                                <small>La imagen debe ser mayor a 844 x 63 píxeles</small>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="page_foot"> <b style="color:red;">*</b>Pie de Página:</label>
                                <input type="text" class="form-control" placeholder="Ej: Dirección y Datos de contactos" name="page_foot" id="page_foot">
                            </div>
                        </div>
                        
                        @if(\Auth::getUser()->user_type=="Admin")
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="price"> <b style="color:red;">*</b>Usuarios:</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="user_id" id="user_id">
                                    @foreach($users as $key)
                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        @else
                        <input type="hidden" name="user_id" value="{{ \Auth::getUser()->id }}">
                        @endif

                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@endsection