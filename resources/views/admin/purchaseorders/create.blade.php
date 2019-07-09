@extends('admin.index')

@section('sub-title')
<title>Himmel! | Registar Orden de Compra</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Orden de Compra</h4>
                
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orden de Compra</li>
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
                <form class="form-horizontal" method="POST" action="{{ route('purchaseorders.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Registrar Orden de Compra <br> <p>Todos los campos son requeridos (<b style="color:red;">*</b>)</p></h4>
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
                                <label for="name"> <b style="color:red;">*</b>Proveedores:</label>
                                <select  class="select2 form-control custom-select" style="width: 100%; height:36px;" name="provider_id" id="provider_id">
                                	@foreach($providers as $key)
                                		<option value="{{ $key->id }}">{{ $key->business_name }} | {{ $key->rut }}</option>
                                	@endforeach
                                </select>
                            </div>
                            
                        </div>
                        @else
                        <input type="hidden" name="user_id" value="{{ \Auth::getUser()->id }}">
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="name"> <b style="color:red;">*</b>Proveedores:</label>
                                <select  class="select2 form-control custom-select" style="width: 100%; height:36px;" name="provider_id" id="provider_id">
                                	@foreach($providers as $key)
                                		<option value="{{ $key->id }}">{{ $key->name }} | {{ $key->rut }}</option>
                                	@endforeach
                                </select>
                            </div>
                            
                        </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="name"> <b style="color:red;">*</b>Productos:</label>
                                <select  class="select2 form-control custom-select" style="width: 100%; height:36px;" name="product_id[]" id="product_id" multiple="multiple"  onchange="getVal(this);">
                                	@foreach($products as $key)
                                		<option value="{{ $key->id }}" title="{{ $key->characteriscs }} | {{ $key->unity }} | {{ $key->existence }}">{{ $key->name }}</option>
                                	@endforeach
                                </select>
                            </div>
                            
                        </div>
                            {{-- <div id="appendInputs"></div> --}}
                        <div  class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Característica</th>
                                            <th scope="col">Unidad</th>
                                            <th scope="col">Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody  id="appendInputs">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="archivos">Archivos:</label>
                                <input type="file" class="form-control" placeholder="Ej: Todo Bien" name="files[]" multiple="multiple" id="files">
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="Comentarios">Comentarios Adicionales:</label>
                                <input type="text" class="form-control" placeholder="Ej: Todo Bien" name="comments" id="comments" value="{{ old('comments') }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="enviar"> Enviar a:</label>
                                <input type="email" class="form-control" name="send_email" id="send_email" placeholder="Ej: miproveedor@gmail.com" value="{{ old('send_email') }}">
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
	var LineNum=0;
	$("#user_id").on("change", function (event) {
	    var id = event.target.value;


	    $.get("/providers/"+id+"/search",function (data) {
	    

	       $("#provider_id").empty();
	       $("#provider_id").append('<option value="" selected disabled> Seleccione el Proveedor</option>');
	        
	        if(data.length > 0){

	            for (var i = 0; i < data.length ; i++) 
	            {  
	                $("#provider_id").removeAttr('disabled');
	                $("#provider_id").append('<option value="'+ data[i].id + '">' + data[i].business_name +'|' + data[i].rut +'</option>');
	            }

	        }else{
	            
	            $("#provider_id").attr('disabled', false);

	        }
		});
		$.get("/products/"+id+"/search",function (data) {
	    

	       $("#product_id").empty();
	       
	        
	        if(data.length > 0){

	            for (var i = 0; i < data.length ; i++) 
	            {  
	                $("#product_id").removeAttr('disabled');
	                $("#product_id").append('<option value="'+ data[i].id +
                    '" title="' + data[i].characteriscs + ' | ' +
                    ' | ' + data[i].unity +' | ' + data[i].existence +
                    '">' + data[i].name + '</option>');
	            }

	        }else{
	            
	            $("#product_id").attr('disabled', false);

	        }
		});
	});
});
</script>
<script type="text/javascript">

var strfn = new Array();

function getVal (element) {

    var products; products = @json($products);   
    var strvalues = $(element).val();

    strfn = [];
    
    strvalues.forEach(function (argument) {    

        products.find(product => {
        
            if ( (product.id == argument) ) strfn.push(product) 

        });
    });

    $('#appendInputs').empty();
    
    strfn.forEach(function (argument) {

        $('#appendInputs').append(function(n){
            return '<tr>'+
                   '<td scope="col">'+ argument.name +'</td>'+
                   '<td scope="col">'+ argument.characteriscs +'</td>'+
                   '<td scope="col">'+ argument.unity +'</td>'+
                   '<td>'+
                   '<div class="form-group">'+
                   '<input type="text" class="form-control" placeholder="0" name="amount[]" id="amount">'+
                   '</div>'+
                   '</td>'+
                   '</tr>';
        });
    });
}
</script>
@endsection
