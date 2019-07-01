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
                                    <th>RIF</th>
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
                                    <td>{{ $key->providers->name }}</td>
                                    <td>{{ $key->providers->letter }} - {{ $key->providers->rif }}</td>
                                    <td>{{ $key->providers->email }}</td>
                                    <td>{{ $key->created_at }}</td>
                                    <td>{{ $key->status }}</td>
                                    <td></td>
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
                                    <th>RIF</th>
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
@endsection

@section('scripts')
<script type="text/javascript">
	$('#zero_config').DataTable();
</script>
@endsection