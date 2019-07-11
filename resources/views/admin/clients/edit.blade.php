@extends('admin.index')

@section('sub-title')
<title>Himmel! | Actualizar Clientes</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Clientes</h4>
                
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Clientes</li>
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
                {!! Form::open(['route' => ['clients.update',$client->id], 'method' => 'PUT', 'name' => 'form', 'id' => 'form','data-parsley-validate']) !!}
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Actualizar Clientes <br> <p>Todos los campos son requeridos (<b style="color:red;">*</b>)</p></h4>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="name"> <b style="color:red;">*</b>Nombre:</label>
                                <input type="text" class="form-control" placeholder="Ej: Carmen Gómez" name="name" id="name" value="{{ $client->name }}">
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="rut"> <b style="color:red;">*</b>RUT:</label>
                                <input type="text" class="form-control" placeholder="Ej: 1234567" name="rut" id="rut" value="{{ $client->rut }}">
                            </div>
                            
                            <div class="col-lg-3">
                                <label for="cedula">Teléfono</label>
                                <input type="text" class="form-control international-inputmask" placeholder="Ej: 52223232323" name="phone" id="phone" value="{{ $client->phone }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="price">Dirección:</label>
                                <input type="text" class="form-control" placeholder="Ej: Av. Los Ríos" name="address" id="address" value="{{ $client->address }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="email"> <b style="color:red;">*</b>Correo:</label>
                                <input type="email" class="form-control" placeholder="Ej: example@gmail.com" name="email" id="email" value="{{ $client->email }}">
                            </div>
                        </div>
                        @if(\Auth::getUser()->user_type=="Admin")
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="price"> <b style="color:red;">*</b>Usuarios:</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="user_id" id="user_id">
                                    @foreach($users as $key)
                                        <option value="{{ $key->id }}" @if($client->user_id==$key->id) selected="selected" @endif>{{ $key->name }}</option>
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
                {!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@endsection