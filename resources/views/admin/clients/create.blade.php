@extends('admin.index')

@section('sub-title')
<title>Himmel! | Registar Clientes</title>
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
                <form class="form-horizontal" method="POST" action="{{ route('clients.store') }}">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Registrar Clientes <br> <p>Todos los campos son requeridos (<b style="color:red;">*</b>)</p></h4>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="name"> <b style="color:red;">*</b>Nombre:</label>
                                <input type="text" class="form-control" placeholder="Ej: Carmen Gómez" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-1">
                                <label for="cedula"> <b style="color:red;">*</b>Cédula:</label>
                                <input type="text" class="form-control" placeholder="Ej: J" name="letter" id="letter" value="{{ old('letter') }}">
                            </div>
                            <div class="col-lg-4">
                            	<label for="cedula">&nbsp;</label>
                                <input type="text" class="form-control" placeholder="Ej: 1234567" name="rif" id="rif" value="{{ old('rif') }}">
                            </div>
                            <div class="col-lg-3">
                                <label for="cedula">Teléfono</label>
                                <input type="text" class="form-control international-inputmask" placeholder="Ej: 52223232323" name="phone" id="phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="price">Dirección:</label>
                                <input type="text" class="form-control" placeholder="Ej: Av. Los Ríos" name="address" id="address" value="{{ old('address') }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="email"> <b style="color:red;">*</b>Correo:</label>
                                <input type="email" class="form-control" placeholder="Ej: example@gmail.com" name="email" id="email" value="{{ old('email') }}">
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