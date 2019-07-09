<html>
<head>
  <title>Orden de Compra N° {{ $purchase->codex }}</title>
  @yield('css')
  <style>
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { 
      position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: ;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
    a {
    	text-decoration: none;
    	color: black;
    }

    table td {
    	padding: 5px;
    }
    th {
    	text-align: center;
    }
    
    .logo {
      width: 100%;
      height: 50px;
      margin-right: 250px;
      margin-top: 20px;
      position: absolute;
    }

    .text-right {
      text-align: right;
    }
  </style>
<body>

  <header>
    <p align="center">
      
      <img src="{{ public_path() . $pdfcontent->url_image }}" class="logo" alt="Cintillo">
    <br><br><br><br>  
    <b><br>
    Orden de Compra N° {{$purchase->codex}}</b>
    </p>
		
</table>
  </header>
  
  <div class="content">
    @yield('content')
  </div>

  <footer>
    <table>
      <tr>
        
        <td>
          <p class="page" style="text-align: center; font-size: 8;">
            {{ $pdfcontent->page_foot }} - Página: 
          </p>
        </td>
      </tr>
    </table>
  </footer>


</body>
</html>