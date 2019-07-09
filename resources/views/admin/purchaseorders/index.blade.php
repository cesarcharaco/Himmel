@extends('admin.index')

@section('sub-title')
<title>Himmel! | Orden de  Compra</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Orden de  Compra</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Orden de  Compra</li>
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
                    <h5 class="card-title"><a href="{{ route('purchaseorders.create') }}" style="color: white;" class="btn btn-info align-right">Registrar Orden de Compra</a></h5>

                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Proveedor</th>
                                    <th>RUT</th>
                                    <th>Correo</th>
                                    <th>Emitida</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseorders as $key)
                                @if(\Auth::getUser()->user_type=="Admin")
                                <tr>
                                    <td>{{ $key->providers->business_name }}</td>
                                    <td>{{ $key->providers->rut }}</td>
                                    <td>{{ $key->providers->email }}</td>
                                    <td>{{ $key->created_at }}</td>
                                    <td>{{ $key->status }}</td>
                                    <td>
                                        @if($key->status=="Sin Aprobar")
                                            <button onclick="approve('{{ $key->id }}')" type="button" class="btn btn-success btn-sm">
                                        <a class="btn-block waves-effect waves-light"  data-toggle="modal" data-target="#approve" title="Aprobar Orden de Compra"><i class="mdi mdi-check"></i>
                                        </a>
                                        </button>
                                        <button onclick="cancel('{{ $key->id }}')" type="button" class="btn btn-danger btn-sm">
                                        <a class="btn-block waves-effect waves-light"  data-toggle="modal" data-target="#cancel" title="Cancelar"><i class="mdi mdi-delete"></i>
                                        </a>
                                        </button>
                                        <button  type="button" class="btn btn-secundary btn-sm">
                                        <a class="btn-block waves-effect waves-light" href="{{ route('purchase.watch',$key->id) }}" title="Ver Orden de Compra"><i class="mdi mdi-eye"></i>
                                        </a>
                                        </button>
                                        @else
                                        
                                        <button  type="button" class="btn btn-secundary btn-sm">
                                        <a class="btn-block waves-effect waves-light" href="{{ route('purchase.watch',$key->id) }}" title="Ver Orden de Compra"><i class="mdi mdi-eye"></i>
                                        </a>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @elseif(\Auth::getUser()->id==$key->providers->user_id)
                                <tr>
                                    <td>{{ $key->providers->name }}</td>
                                    <td>{{ $key->providers->letter }} - {{ $key->providers->rif }}</td>
                                    <td>{{ $key->providers->email }}</td>
                                    <td>{{ $key->created_at }}</td>
                                    <td>{{ $key->status }}</td>
                                    <td></td>
                                </tr>

                                @endif
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Proveedor</th>
                                    <th>RUT</th>
                                    <th>Correo</th>
                                    <th>Emitida</th>
                                    <th>Estado</th>
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
<!-- INICIO DEL MODAL DE APPROVE -->
<div class="modal none-border" id="approve">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Aprobar Orden de compra</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            {!! Form::open(['route' => ['purchase.approve'], 'method' => 'POST']) !!}
                                @csrf
                            <div class="modal-body">
                                <strong>Está seguro de Aprobar ésta Orden de Compra?</strong>
                                <input type="hidden" name="purchase_id" id="purchase_id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success save-event waves-effect waves-light">Aprobar</button>
                                
                            </div>
                            {!! Form::close() !!}               </div>
                    </div>
                </div>
                <!-- END MODAL DE APPROVE-->
<!-- INICIO DEL MODAL DE CANCEL -->
<div class="modal none-border" id="cancel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><strong>Cancelar Orden de compra</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            {!! Form::open(['route' => ['purchase.cancel'], 'method' => 'POST']) !!}
                                @csrf
                            <div class="modal-body">
                                <strong>Está seguro de Cancelar ésta Orden de Compra?</strong>
                                <input type="hidden" name="purchase_id" id="purchase_id2">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success save-event waves-effect waves-light">Cancelar</button>
                                
                            </div>
                            {!! Form::close() !!}               </div>
                    </div>
                </div>
                <!-- END MODAL DE CANCEL-->     
@endsection

@section('scripts')
<script type="text/javascript">

    function cancel(purchase_id) {
        $("#purchase_id2").val(purchase_id);
    }

    function approve(purchase_id) {
        $("#purchase_id").val(purchase_id);
    }
</script>
@endsection