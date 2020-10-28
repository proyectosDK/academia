<html>
<head>
    <style>
      table {
        width:100% !important;
      }

      th {
        background-color: #101010;
        color: white;
      }

      table, th, td {
        border: 1px solid black;
      }
      
      .logo {
            position: fixed;
            text-align: left;
            margin: 30px, 20px, 0px, 0px;
        }
    </style>
</head>
<body>
  <header>
      <img class="logo" src="{{asset('img/logo.jpg')}}" width="100px" height="100px" />
      <h2 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;"> COLEGIO INTEGRAL CIUDAD PEDRO DE ALVARADO</h2>
      <h3 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">REPORTE DE ALUMNOS</h3>
      <h5 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Fecha {{ date('d/m/Y H:i:s') }}</h5>
  </header>
  <br />
  <table>
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Alumno</th>
        <th>Encargado</th>
        <th>Telefono encargado</th>
        <th>Dirección</th>
      </tr>
    </thead>
    <thead>
      @foreach($alumnos as $alumno)
      <tr>
        <td>{{$alumno->id}}</td>
        <td>{{$alumno->nombres}}</td>
         <td>{{$alumno->nombre_encargado}}</td>
        <td>{{$alumno->telefono_encargado}}</td>
        <td>{{$alumno->direccion}}</td>
      </tr>
      @endforeach
    </thead>
  </table>
</body>
</html>
