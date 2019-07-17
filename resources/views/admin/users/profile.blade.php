@extends('admin.index')

@section('sub-title')
<title>Himmel! | Mi Perfil</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Usuario</h4>
                
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
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
                <div class="card-body">
                    <h4 class="card-title">Mis datos <br></h4>
                	<div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right"><b>Nombre:</b></label>
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ $user->name }}</label>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label text-md-right"><b>Correo: </b></label>
                        <label for="email" class="col-md-2 col-form-label text-md-right">{{ $user->email }} </label>
                    </div>
                    
       				<div class="form-group row">
                        <label for="log_enterprise" class="col-md-2 col-form-label text-md-right"><b>Nombre de la Empresa:</b></label>
                        <label for="log_enterprise" class="col-md-2 col-form-label text-md-right">{{ $user->log_enterprise }} </label>
                    </div>
                    <div class="form-group row">
                        <label for="log_enterprise" class="col-md-2 col-form-label text-md-right"><b>Status:</b></label>
                        <label for="log_enterprise" class="col-md-2 col-form-label text-md-right">{{ $user->status }} </label>
                    </div>
                    <div class="form-group row">
                        <label for="log_enterprise" class="col-md-2 col-form-label text-md-right"><b>Tipo de Usuario:</b></label>
                        <label for="log_enterprise" class="col-md-2 col-form-label text-md-right">{{ $user->user_type }} </label>
                    </div>             
               </div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@endsection