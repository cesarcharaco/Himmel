@extends('admin.index')

@section('sub-title')
<title>Himmel! | Registar Cotización</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Cotización</h4>
                
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cotización</li>
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
                <form class="form-horizontal" method="POST" action="{{ route('quotations.store') }}">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Registrar Cotización <br> <p>Todos los campos son requeridos (<b style="color:red;">*</b>)</p></h4>
                        @if(\Auth::getUser()->user_type=="Admin")
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="price"> <b style="color:red;">*</b>Usuarios:</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="user_id" id="user_id">
                                	<option value="">Seleccione un usuario</option>
                                    @foreach($users as $key)
                                        <option value="{{ $key->id }}">{{ $key->name }} | {{ $key->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="name"> <b style="color:red;">*</b>Clientes:</label>
                                <select  class="select2 form-control custom-select" style="width: 100%; height:36px;" name="client_id" id="client_id">
                                	@foreach($clients as $key)
                                		<option value="{{ $key->id }}">{{ $key->name }} | {{ $key->letter }}-{{ $key->rif }}</option>
                                	@endforeach
                                </select>
                            </div>
                            
                        </div>
                        @else
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="name"> <b style="color:red;">*</b>Clientes:</label>
                                <select  class="select2 form-control custom-select" style="width: 100%; height:36px;" name="client_id" id="client_id">
                                	@foreach($clients as $key)
                                		<option value="{{ $key->id }}">{{ $key->name }} | {{ $key->letter }}-{{ $key->rif }}</option>
                                	@endforeach
                                </select>
                            </div>
                            
                        </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="name"> <b style="color:red;">*</b>Productos:</label>
                                <select  class="select2 form-control custom-select" style="width: 100%; height:36px;" name="products_select" id="products_select">
                                	@foreach($products as $key)
                                		<option value="{{ $key->id }}">{{ $key->name }} | {{ $key->characteriscs }} | {{ $key->unity }} | {{ $key->existence }}</option>
                                	@endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="cedula"> <b style="color:red;">*</b>Lista de Productos:</label>
                                <div class="table-responsive">
                        			<table id="lista_productos" class="table table-striped table-bordered">
			                            <thead>
			                                <tr>
			                                    <th>Nombre</th>
			                                    <th>Característica</th>
			                                    <th>Unidad</th>
			                                    <th>Precio</th>
			                                    <th>Acciones</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            	@foreach($car as $key)
			                                <tr>
			                                	<td>{{ $key->name }}</td>
			                                	<td>{{ $key->characteriscs }}</td>
			                                	<td>{{ $key->unity }}</td>
			                                	<td>{{ $key->price }}</td>
			                                	<td><button type="button" id="product_delete" class="btn btn-danger btn-sm"><i class="m-r-6 mdi mdi-delete"></i><code class="m-r-10"></code></button></td>
			                                </tr>
			                                @endforeach
			                            </tbody>
			                        </table>
                    			</div>
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
<script type="text/javascript">

$(document).ready( function(){
	$("#user_id").on("change", function (event) {
	    var id = event.target.value;


	    $.get("/clients/"+id+"/search",function (data) {
	    

	       $("#client_id").empty();
	       $("#client_id").append('<option value="" selected disabled> Seleccione el Cliente</option>');
	        
	        if(data.length > 0){

	            for (var i = 0; i < data.length ; i++) 
	            {  
	                $("#client_id").removeAttr('disabled');
	                $("#client_id").append('<option value="'+ data[i].id + '">' + data[i].name +'|' + data[i].letter +'-' + data[i].rif +'</option>');
	            }

	        }else{
	            
	            $("#client_id").attr('disabled', false);

	        }
		});
		$.get("/products/"+id+"/search",function (data) {
	    

	       $("#products_select").empty();
	       $("#products_select").append('<option value="" selected disabled> Seleccione un Producto</option>');
	        
	        if(data.length > 0){

	            for (var i = 0; i < data.length ; i++) 
	            {  
	                $("#products_select").removeAttr('disabled');
	                $("#products_select").append('<option value="'+ data[i].id + '">' + data[i].name +' | ' + data[i].characteriscs +' | ' + data[i].unity +' | ' + data[i].unity +'</option>');
	            }

	        }else{
	            
	            $("#products_select").attr('disabled', false);

	        }
		});
	});
	$("#products_select").on("change", function (event) {
	    var id = event.target.value;


	    $.get("/products/"+id+"/add",function (data) {
	    

	       //$("#lista_productos").empty();
	       
	        
	        if(data.length > 0){

	            for (var i = 0; i < data.length ; i++) 
	            {
	             	//$("#lista_productos").append('<tr>'); 
	                //$("#products").removeAttr('disabled');
	                $("#lista_productos").append('<tr><td><input type="hidden" name="product_id[]" id="product_id" value="'+ data[i].id + '">' + data[i].name +'</td><td>'+ data[i].characteriscs +'</td><td>' + data[i].unity +'</td><td>'+ data[i].price +'</td><td><button type="button" value="'+ data[i].id + '" id="product_delete" class="btn btn-danger btn-sm"><i class="m-r-10 mdi mdi-delete"><code class="m-r-10"></code></button></td></tr>');
	                //$("#lista_productos").append('</tr>');
	            }

	        }else{
	            
	            //$("#client_id").attr('disabled', false);

	        }
		});
	});

	$("#product_delete").on("click", function (event) {
	    var id = event.target.value;


	    $.get("/products/"+id+"/delete",function (data) {
	    

	       $("#lista_productos").empty();
	       
	        
	        if(data.length > 0){

	            for (var i = 0; i < data.length ; i++) 
	            {
	             	//$("#lista_productos").append('<tr>'); 
	                //$("#products").removeAttr('disabled');
	                $("#lista_productos").append('<tr><td><input type="hidden" name="product_id[]" id="product_id" value="'+ data[i].id + '">' + data[i].name +'</td><td>'+ data[i].characteriscs +'</td><td>' + data[i].unity +'</td><td>'+ data[i].price +'</td><td></td></tr>');
	                //$("#lista_productos").append('</tr>');
	            }

	        }else{
	            
	            //$("#client_id").attr('disabled', false);

	        }
		});
	});
});
</script>
@endsection