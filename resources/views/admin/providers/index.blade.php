@extends('admin.index')

@section('sub-title')
<title>Himmel! | Proveedores</title>
@endsection

@section('css')
@endsection
@section('sub-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Proveedores</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
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
                    <h5 class="card-title"><a href="{{ route('providers.create') }}" style="color: white;" class="btn btn-info align-right">Registrar Cliente</a></h5>

                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre de la Empresa</th>
                                    <th>Cédula</th>
                                    <th>Representante</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($providers as $key)
                                <tr>
                                    <td>{{ $key->business_name }}</td>
                                    <td>{{ $key->letter }} - {{ $key->rif }}</td>
                                    <td>{{ $key->salesman }}</td>
                                    <td>{{ $key->address }}</td>
                                    <td>{{ $key->email }}</td>
                                    <td>{{ $key->phone }}</td>
                                    <td></td>
                                </tr>
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre de la Empresa</th>
                                    <th>Cédula</th>
                                    <th>Representante</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
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