@extends('admin.index')

@section('sub-title')
<title>Himmel! | Usuarios</title>
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
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('users.create') }}" style="color: white;" class="btn btn-info align-right">Registrar Usuario</a></h5>

                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Tipo</th>
                                    <th>Empresa</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key)
                                <tr>
                                    <td>{{ $key->name }}</td>
                                    <td>{{ $key->email }}</td>
                                    <td>{{ $key->user_type }}</td>
                                    <td>{{ $key->log_enterprise }}</td>
                                    <td>{{ $key->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" title="Editar">
                                        <a href="{{ route('users.edit',$key->id) }}"><i class="mdi mdi-pencil"></i></a>
                                        </button>

                                        <button onclick="cambiar_status('{{ $key->id }}','{{ $key->status }}')" type="button" class="btn btn-success btn-sm">
                                        <a class="btn-block waves-effect waves-light"  data-toggle="modal" data-target="#my-event" title="Cambiar Status"><i class="mdi mdi-bell"></i>
                                        </a>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Tipo</th>
                                    <th>Empresa</th>
                                    <th>Status</th>
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
                <h4 class="modal-title"><strong>Cambiar Status del Usuario a <span id="nuevo_status"></span> </strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            {!! Form::open(['route' => ['users.destroy',1033], 'method' => 'DELETE']) !!}
                @csrf
            <div class="modal-body">
                <strong>Está seguro de Cambiar el Status de éste usuario?</strong>
                <input type="hidden" name="user_id" id="user_id">
                <input type="hidden" name="status" id="status">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success save-event waves-effect waves-light">Cambiar Status</button>
                
            </div>
            {!! Form::close() !!}               </div>
    </div>
</div>
<!-- END MODAL -->

@endsection

@section('scripts')
<script type="text/javascript">
	$('#zero_config').DataTable();

    function cambiar_status(user_id,status) {
        if (status=="Activo") {
            $("#nuevo_status").text('Suspendido');
            $("#status").val('Suspendido');
        }else{
            $("#nuevo_status").text('Activo');
            $("#status").val('Activo');
        }
        $("#user_id").val(user_id);
    }
</script>
@endsection