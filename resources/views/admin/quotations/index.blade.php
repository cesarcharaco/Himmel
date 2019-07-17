@extends('admin.index')

@section('sub-title')
<title>Himmel! | Cotizaciones</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Cotizaciones</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cotizaciones</li>
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
                    <h5 class="card-title"><a href="{{ route('quotations.create') }}" style="color: white;" class="btn btn-info align-right">Registrar Cotización</a></h5>

                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>RUT</th>
                                    <th>Correo</th>
                                    <th>Emitida</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quotations as $key)
                                <tr>
                                    <td>{{ $key->clients->name }}</td>
                                    <td>{{ $key->clients->rut }}</td>
                                    <td>{{ $key->clients->email }}</td>
                                    <td>{{ $key->created_at }}</td>
                                    <td>
                                        
                                        <button onclick="destroy('{{ $key->id }}')" type="button" class="btn btn-danger btn-sm">
                                        <a class="btn-block waves-effect waves-light"  data-toggle="modal" data-target="#my-event" title="Eliminar Información"><i class="mdi mdi-delete"></i>
                                        </a>
                                        </button>
                                        <button  type="button" class="btn btn-secundary btn-sm">
                                        <a class="btn-block waves-effect waves-light" href="{{ route('quotations.watch',$key->id) }}" title="Ver Orden de Cotización"><i class="mdi mdi-eye"></i>
                                        </a>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Cliente</th>
                                    <th>RUT</th>
                                    <th>Correo</th>
                                    <th>Emitida</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<!--INICIO DEL MODAL -->

<div class="modal none-border" id="my-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Eliminar Registro</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            {!! Form::open(['route' => ['quotations.destroy',1033], 'method' => 'DELETE']) !!}
                @csrf
            <div class="modal-body">
                <strong>Está seguro de Eliminar este registro?</strong>
                <input type="hidden" name="quotation_id" id="quotation_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success save-event waves-effect waves-light">Eliminar</button>
                
            </div>
            {!! Form::close() !!}               </div>
    </div>
</div>
<!-- END MODAL -->
@endsection

@section('scripts')
<script type="text/javascript">
	$('#zero_config').DataTable();
    function destroy(quotation_id) {
        $("#quotation_id").val(quotation_id);
    }
</script>
@endsection