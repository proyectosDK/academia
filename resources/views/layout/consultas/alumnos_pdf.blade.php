<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> 
    <title>reporte</title>
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
    </style>
</head>
<body>
  <head>
      <h2 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;"> COLEGIO INTEGRAL CIUDAD PEDRO DE ALVARADO</h2>
      <h3 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">REPORTE DE ALUMNOS</h3>
      <h5 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Fecha {{ date('d/m/Y H:i:s') }}</h5>
  </head>
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
