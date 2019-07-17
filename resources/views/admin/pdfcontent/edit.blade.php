@extends('admin.index')

@section('sub-title')
<title>Himmel! | Actualizar Datos del Contenido del PDF</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Contenido PDF</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contenido PDF</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    @include('flash::message')
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
            <div class="card">
                {!! Form::open(['route' => ['pdfcontent.update',$pdfcontent->id], 'method' => 'PUT', 'name' => 'form', 'id' => 'form','data-parsley-validate', 'enctype' =>'multipart/form-data']) !!}

                        @csrf
                    <div class="card-body">
                        <h4 class="card-title">Actualizar Contenido del PDF</h4>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="name">Imagen Actual:</label>
                                <img src="{{ asset($pdfcontent->url_image) }}">
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="characteriscs">Imagen de Encabezado:</label>
                                <input type="file" class="form-control" name="image" id="characteriscs">
                                <small>La imagen debe ser mayor a 844 x 63 píxeles</small>
                            </div>
                            <div class="col-lg-6">
                                <label for="page_foot"> <b style="color:red;">*</b>Pie de Página:</label>
                                <input type="text" class="form-control" placeholder="Características" name="page_foot" id="page_foot" value="{{ $pdfcontent->page_foot }}">
                            </div>
                        </div>
                        @if(\Auth::getUser()->user_type=="Admin")
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="price"> <b style="color:red;">*</b>Usuarios:</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="user_id" id="user_id">
                                    @foreach($users as $key)
                                        <option value="{{ $key->id }}" @if($key->id==$pdfcontent->user_id) selected="selected" @endif >{{ $key->name }}</option>
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
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
		</div>
	</div>
</div>

@endsection
