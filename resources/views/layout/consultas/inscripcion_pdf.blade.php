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
      <h3 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">REPORTE DE INSCRIPCIONES CICLO ESCOLAR {{$ciclo->ciclo}}</h3>
      <h5 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Fecha {{ date('d/m/Y H:i:s') }}</h5>
  </head>
  <br />
  <table class="blueTable">
    <thead>
      <tr>
        <th>Codigo alumno</th>
        <th>Alumno</th>
        <th>Institucion educativa</th>
        <th>Cursos asignados</th>
        <th>Fecha inscripcion</th>
      </tr>
    </thead>
    <thead>
      @foreach($inscripciones as $inscripcion)
      <tr>
        <td>{{$inscripcion->codigo_alumno}}</td>
        <td>{{$inscripcion->nombres}}</td>
         <td>{{$inscripcion->institucion}}</td>
        <td>{{$inscripcion->cursos_asignados}}</td>
        <td>{{$inscripcion->fecha}}</td>
      </tr>
      @endforeach
    </thead>
  </table>
</body>
</html>
