@extends('admin.pdfs.partials.layouts-purchase')
@section('css')
<style>
  table{
    width: 100%;
  }
  .content_table{
      font-size: 10;
    }
  th {
    padding: 5px;
  }
  td{
  	text-align: left;
  	font-size: ;
  	padding: 5px;
  	height: 5px;
  }
</style>
@endsection

@section('content')

<table id="purchase" border="0" class="content_table">
	
		
	    	<tr class="tr-shadow">
	    		<td  align="left"><b>Fecha de Emisión:</b> {{ $purchase->date }}</td>
	    	</tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Proveedor:</b> {{ $purchase->providers->business_name }} <b>- RUT: </b> {{ $purchase->providers->rut }}</td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Status:</b> {{ $purchase->status }}</td>
        </tr>
    	 <tr class="tr-shadow">
          <td  align="left"><b>Comentarios de Correo:</b> {{ $purchase->comments }}</td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Correo para envío:</b> {{ $purchase->send_email }}</td>
        </tr>
        <tr><td><br><b>Productos</b></td></tr>
</table>
<table border="1">
    
    <tr><th>Nombre</th><th>Carcterísticas</th><th>Unidad</th><th>Cantidad</th></tr>
    @foreach($purchase->products as $key)
    <tr class="tr-shadow">
      <td>{{ $key->name }}</td>
      <td>{{ $key->characteriscs }}</td>
      <td>{{ $key->unity }}</td>
      <td>{{ $key->pivot->amount }}</td>
    </tr>            
    @endforeach
</table>
@endsection