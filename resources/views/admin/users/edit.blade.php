@extends('admin.index')

@section('sub-title')
<title>Himmel! | Actualizar Usuarios</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Usuarios</h4>
                
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
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
                {!! Form::open(['route' => ['users.update',$user->id], 'method' => 'PUT', 'name' => 'form', 'id' => 'form','data-parsley-validate']) !!}
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Actualizar Usuarios <br> <p>Todos los campos son requeridos (<b style="color:red;">*</b>)</p></h4>
                    	<div class="form-group row">
                            <label for="name" class="col-md-1 col-form-label text-md-right"><b style="color:red;">*</b>Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="Ej: Martin Ferrer">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-1 col-form-label text-md-right"><b style="color:red;">*</b>Correo</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="Ej: micorreo@gmail.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
           				<div class="form-group row">
                            <label for="log_enterprise" class="col-md-1 col-form-label text-md-right">Nombre de la Empresa</label>

                            <div class="col-md-6">
                                <input id="log_enterprise" type="text" class="form-control @error('log_enterprise') is-invalid @enderror" name="log_enterprise" value="{{ $user->log_enterprise }}" autocomplete="log_enterprise" autofocus placeholder="Ej: Inversiones Martín C.A.">

                                @error('log_enterprise')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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