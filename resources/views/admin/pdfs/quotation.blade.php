@extends('admin.pdfs.partials.layouts-quotation')
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

<table id="quotation" border="0" class="content_table">
	
		
	    	<tr class="tr-shadow">
	    		<td  align="left"><b>Fecha de Emisión:</b> {{ $quotation->created_at }}</td>
	    	</tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Cliente:</b> {{ $quotation->clients->name }} <b>- RUT: </b> {{ $quotation->clients->rut }}</td>
        </tr>
    	 <tr class="tr-shadow">
          <td  align="left"><b>Comentarios de Correo:</b> {{ $quotation->email_comments }}</td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Correo para envío:</b> {{ $quotation->clients->email }}</td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Oferta Válida:</b> {{ $quotation->offer_validity }}</td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Plazo de Validez:</b> {{ $quotation->time_delivery }}</td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Lugar de Entrega:</b> {{ $quotation->place_delivery }}</td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Términos de Entrega:</b> {{ $quotation->delivery_term }}</td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Forma de Pago:</b> {{ $quotation->way_pay }} | <b>Moneda:</b>{{ $quotation->coin }} </td>
        </tr>
        <tr class="tr-shadow">
          <td  align="left"><b>Dirigido a:</b> {{ $quotation->addressed_to }}</td>
        </tr>


        <tr><td><br><b>Productos</b></td></tr>
</table>
<table border="1">
    
    <tr><th>Nombre</th><th>Carcterísticas</th><th>Unidad</th><th>Cantidad</th></tr>
    @foreach($quotation->products as $key)
    <tr class="tr-shadow">
      <td>{{ $key->name }}</td>
      <td>{{ $key->characteriscs }}</td>
      <td>{{ $key->unity }}</td>
      <td>{{ $key->pivot->amount }}</td>
    </tr>            
    @endforeach
</table>
@endsection