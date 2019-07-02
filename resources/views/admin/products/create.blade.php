@extends('admin.index')

@section('sub-title')
<title>Himmel! | Registar productos</title>
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
                <form class="form-horizontal" method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Registrar productos</h4>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="characteriscs">Características:</label>
                                <input type="text" class="form-control" placeholder="Características" name="characteriscs" id="characteriscs" value="{{ old('characteriscs') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="existence">Existencia:</label>
                                <input type="text" class="form-control" placeholder="Existencia" name="existence" id="existence" value="{{ old('existence') }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="characteriscs">Unidad:</label>
                                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="unity" id="unity">
                                    <option>Select</option>
                                    <optgroup label="Seleccione una unidad">
                                        <option value="Caja">Caja</option>
                                        <option value="Bulto">Bulto</option>
                                        <option value="Saco">Saco</option>
                                        <option value="M3">M3</option>
                                        <option value="Resma">Resma</option>
                                        <option value="Paquete">Paquete</option>
                                        <option value="kilo">kilo</option>
                                        <option value="Barril">Barril</option>
                                        <option value="Litros">Litros</option>
                                        <option value="Individual">Individual</option>
                                    </optgroup>
                                </select>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label for="price">Precio:</label>
                                <input type="text" class="form-control" placeholder="Precio" name="price" id="price" value="{{ old('price') }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="stock_min">Stock mínimo:</label>
                                <input type="text" class="form-control" placeholder="Stock mínimo" name="stock_min" id="stock_min" value="{{ old('stock_min') }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="stock_max">Stock máximo:</label>
                                <input type="text" class="form-control" placeholder="Stock máximo" name="stock_max" id="stock_max" value="{{ old('stock_max') }}">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
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