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
                <form class="form-horizontal" method="POST" action="{{ route('quotations.store') }}" enctype="multipart/form-data">
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
			                                    <th>Cantidad</th>
			                                    <th>Acciones</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            	
			                            </tbody>
			                            <tfoot>
			                            	<tr><th colspan="4"></th><th>Total: <span id="total"></span></th><th></th></tr>
			                            </tfoot>
			                        </table>
                    			</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="Comentarios">Comentarios:</label>
                                <input type="text" class="form-control" placeholder="Ej: Todo Bien" name="comments" id="comments" value="{{ old('comments') }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="Descuento"> Descuento:</label>
                                <input type="number" class="form-control" name="discount" id="discount" value="{{ old('discount') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <label for="Comentarios">Archivos:</label>
                                <input type="file" multiple="multiple" class="form-control" placeholder="Ej: Todo Bien" name="files[]" id="files" >
                            </div>
                        </div>
                        <div class="row mb-3">
                        	<div class="col-lg-4">
                        	<label for="Comentarios"><b>Condiciones Generales:</b></label>	
                        	</div>
                        </div>
                        <div class="row mb-3">
                        	
                            <div class="col-lg-4">
                                <label for="Validez"><b style="color:red;">*</b>Validez de Oferta:</label>
                                <input type="date"  value="{{$hoy}}" min="{{$hoy}}" required="required"  class="form-control" placeholder="Ej: Todo Bien" name="offer_validity" id="offer_validity">
                            </div>
                            <div class="col-lg-4">
                                <label for="Lugar"><b style="color:red;">*</b> Lugar de entrega:</label>
                                <input type="text" class="form-control" name="place_delivery" id="place_delivery" value="{{ old('place_delivery') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                        	
                            <div class="col-lg-4">
                                <label for="plazo"><b style="color:red;">*</b>Plazo de Entrega:</label>
                                <input type="date"  value="{{$hoy}}" min="{{$hoy}}" required="required"  class="form-control" placeholder="Ej: Todo Bien" name="offer_validity" id="offer_validity" value="{{ old('offer_validity') }}">
                            </div>
                            <div class="col-lg-2">
                                <label for="Lugar"><b style="color:red;">*</b> Forma de Pago:</label>
                                <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="way_pay" name="way_pay" checked="checked" value="Transferencia">
                                <label class="custom-control-label" for="customControlValidation1">Transferencia</label>
                            	</div>
                             <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="way_pay1" name="way_pay" value="Efectivo">
                                <label class="custom-control-label" for="customControlValidation2">Efectivo</label>
                            </div>
                            </div>
                            <div class="col-lg-2">
                                <label for="Moneda"><b style="color:red;">*</b>Moneda</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="coin" id="coin">
                                        <option value="Dolar USD">Dolar USD</option>
                                        <option value="Pesos">Pesos</option>
                                        <option value="Soles">Soles</option>
                                        <option value="Bitcoin">Bitcoin</option>
                                        <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                        	<div class="col-lg-4">
                        	<label for="Comentarios"><b>Adiciones al Correo:</b></label>	
                        	</div>
                        </div>
                        <div class="row mb-3">
                        	
                            <div class="col-lg-4">
                                <label for="adiciones">Dirigido a:</label>
                                <input type="text"  value="{{old('address_to')}}" required="required"  class="form-control" placeholder="Ej: Todo Bien" name="address_to" id="address_to">
                            </div>
                            <div class="col-lg-4">
                                <label for="Comentarios Correo">Comentarios del Correo:</label>
                                <textarea class="form-control" name="email_comments" id="email_comments"></textarea>
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
	       $("#products_select").append('<option value="0" selected disabled> Seleccione un Producto</option>');
	        
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
	        	LineNum++;
	            for (var i = 0; i < data.length ; i++) 
	            {
	            	//$('#products_select').children('option[value="'+id+'"]').attr('disabled',true);
	             	//$("#lista_productos").append('<tr>'); 
	                //$("#products").removeAttr('disabled');
	                $("#lista_productos").append('<tr id="Line'+LineNum+'"><td><input type="hidden" name="product_id[]" id="product_id" value="'+ data[i].id + '">' + data[i].name +'</td><td>'+ data[i].characteriscs +'</td><td>' + data[i].unity +'</td><td>'+ data[i].price +'</td><td><input type="number" name="cantidad[]" id="cantidad required="required"></td><td><button type="button" onclick="EliminarLinea('+LineNum+','+data[i].id+');"  class="btn btn-danger btn-sm"><i class="m-r-10 mdi mdi-delete"><code class="m-r-10"></code></button></td></tr>');
	                //$("#lista_productos").append('</tr>');
	            }

	        }else{
	            
	            //$("#client_id").attr('disabled', false);

	        }
		});
	});

	
});
function EliminarLinea(rnum,id_opcion) {
	var next=id_opcion-1;
	//console.log(id_opcion+" siguiente "+next);
	/*$('#products_select').children('option[value="'+next+'"]').attr('selected',true);
	$('#products_select').children('option[value="'+id_opcion+'"]').removeAttr('disabled');*/
	$('#Line'+rnum).remove();
        return true;
}
</script>
@endsection
