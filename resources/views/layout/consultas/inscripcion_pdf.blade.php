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
