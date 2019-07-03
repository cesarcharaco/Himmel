@extends('admin.index')

@section('sub-title')
<title>Himmel! | Actualizar productos</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Productos</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Productos</li>
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
                {!! Form::open(['route' => ['products.update',$product->id], 'method' => 'PUT', 'name' => 'form', 'id' => 'form','data-parsley-validate']) !!}

                        @csrf
                    <div class="card-body">
                        <h4 class="card-title">Actualizar producto</h4>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name" id="name" value="{{ $product->name }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="characteriscs">Características:</label>
                                <input type="text" class="form-control" placeholder="Características" name="characteriscs" id="characteriscs" value="{{ $product->characteriscs }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="existence">Existencia:</label>
                                <input type="text" class="form-control" placeholder="Existencia" name="existence" id="existence" value="{{ $product->existence }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="characteriscs">Unidad:</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="unity" id="unity">
                                    <option>Select</option>
                                    <optgroup label="Seleccione una unidad">
                                        <option value="Caja" @if($product->unity=="Caja") selected="selected" @endif >Caja</option>
                                        <option value="Bulto" @if($product->unity=="Bulto") selected="selected" @endif >Bulto</option>
                                        <option value="Saco" @if($product->unity=="Saco") selected="selected" @endif >Saco</option>
                                        <option value="M3" @if($product->unity=="M3") selected="selected" @endif >M3</option>
                                        <option value="Resma" @if($product->unity=="Resma") selected="selected" @endif >Resma</option>
                                        <option value="Paquete" @if($product->unity=="Paquete") selected="selected" @endif >Paquete</option>
                                        <option value="kilo" @if($product->unity=="kilo") selected="selected" @endif >kilo</option>
                                        <option value="Barril" @if($product->unity=="Barril") selected="selected" @endif >Barril</option>
                                        <option value="Litros" @if($product->unity=="Litros") selected="selected" @endif >Litros</option>
                                        <option value="Individual" @if($product->unity=="Individual") selected="selected" @endif >Individual</option>
                                    </optgroup>
                                </select>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="price">Precio:</label>
                                <input type="text" class="form-control" placeholder="Precio" name="price" id="price" value="{{ $product->price }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="stock_min">Stock mínimo:</label>
                                <input type="text" class="form-control" placeholder="Stock mínimo" name="stock_min" id="stock_min" value="{{ $product->stock_min }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="stock_max">Stock máximo:</label>
                                <input type="text" class="form-control" placeholder="Stock máximo" name="stock_max" id="stock_max" value="{{ $product->stock_max }}">
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col">
                        		<div class="table-responsive" style="border-color: blue;">
                        			<table id="zero_config" class="table table-striped table-bordered">
                        				<thead>
                        					<tr>
                        						<td>Proveedor</td>
                        						<td>Costo</td>
                                                <td>Acciones</td>
                        					</tr>
                        				</thead>
                        				<tbody>
                        					
                        					@foreach($product->providers as $key)
                        						<tr>
                        							<td>{{ $key->business_name}} | {{ $key->letter }}- {{ $key->rif }}</td>
                        							<td>{{ $key->pivot->cost }}</td> 
                                                    <td >
                                                        <button onclick="delete_provider('{{ $key->pivot->product_id }}','{{ $key->pivot->provider_id }}')" type="button" class="btn btn-danger btn-sm">
                                                        <a class="btn-block waves-effect waves-light"  data-toggle="modal" data-target="#my-event" title="Eliminar Proveedor"><i class="mdi mdi-delete"></i>
                                                        </a>
                                                        </button>
                                                    </td>
                        						</tr>
                        					@endforeach

                        				</tbody>
                        			</table>	
                        		</div>
                        	</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="provider_id">Proveedores</label>
                                <div class="form-group">
                                    <select onchange="getVal(this);" name="provider_id[]" id="provider_id" class="select2 form-control m-t-15" multiple="multiple">
                                        @foreach($providers as $key)
                                            <option value="{{ $key->id }}">{{ $key->business_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="appendInputs"></div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>

<div class="modal none-border" id="my-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Eliminar Proveedor</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form action="{{ route('product.delete.provider') }}" method="POST" name="eliminar">
                                @csrf
                            <div class="modal-body">
                                <strong>Está seguro de Eliminar este proveedor?</strong>
                                <input type="hidden" name="product_id" id="product_id2">
                                <input type="hidden" name="provider_id" id="provider_id2">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success save-event waves-effect waves-light">Eliminar</button>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->
@endsection

@section('scripts')

<script type="text/javascript">

function delete_provider(product_id,provider_id) {
    console.log("sasasas");
    $("#product_id2").val(product_id);
    $("#provider_id2").val(provider_id);
}
var strfn = new Array();

function getVal (element) {

    var providers; providers = @json($providers);   
    var strvalues = $(element).val();

    strfn = [];
    
    strvalues.forEach(function (argument) {    

        providers.find(provider => {
        
            if ( (provider.id == argument) ) strfn.push(provider) 

        });
    });

    $('#appendInputs').empty();

    strfn.forEach(function (argument) {

        $('#appendInputs').append(function(n){
            return '<div class="row">'+
                   '<div class="col">'+
                   '<label for="cost">'+ argument.business_name +'</label>'+
                   '<div class="form-group">'+
                   '<input type="text" class="form-control" placeholder="0" name="cost[]" id="cost">'+
                   '</div>'+
                   '</div>'+
                   '</div>';
        });
    });
}


</script>
@endsection