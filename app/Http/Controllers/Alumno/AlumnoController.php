<?php

namespace App\Http\Controllers\Alumno;

use App\Alumno;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//retornar registro por id
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.administracion.alumno');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $alumnos = Alumno::with('municipio.departamento','encargado')->get();
        return $this->showAll($alumnos);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'primer_nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'municipio_id' =>'required|exists:municipios,id',
            'encargado_id' =>'required|exists:encargados,id',
            'direccion' => 'required|string',
            'fecha_nac' => 'required|string'
        ];
        
        $this->validate($request, $reglas);

        $imagePath = '';
        if (preg_match('/^data:image\/(\w+);base64,/', $request->image_file)) {
            $data = substr($request->image_file, strpos($request->image_file, ',') + 1);
            $data = base64_decode($data);
            $imagePath = $request->codigo.'_'.time().'.png';;
            Storage::disk('images')->put($imagePath, $data);
        }

        $data = $request->all();

        $data['foto'] = $imagePath;

        $alumno = Alumno::create($data);

        return $this->showOne($alumno,201);
    }

    //mostrar registro por id
    public function show(Alumno $alumno)
    {
        return $this->showOne($alumno);
    }

    //actualizar registro
    public function update(Request $request, Alumno $alumno)
    {
        $reglas = [
            'primer_nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'municipio_id' =>'required|exists:municipios,id',
            'encargado_id' =>'required|exists:encargados,id',
            'direccion' => 'required|string',
            'fecha_nac' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $alumno->primer_nombre = $request->primer_nombre;
        $alumno->segundo_nombre = $request->segundo_nombre;
        $alumno->primer_apellido = $request->primer_apellido;
        $alumno->segundo_apellido = $request->segundo_apellido;
        $alumno->municipio_id = $request->municipio_id;
        $alumno->direccion = $request->direccion;
        $alumno->encargado_id = $request->encargado_id;
        $alumno->fecha_nac = $request->fecha_nac;
        $alumno->telefono = $request->telefono;

        if($request->image_file != null || $request->image_file != ''){
            $imagePath = '';
            if (preg_match('/^data:image\/(\w+);base64,/', $request->image_file)) {
                $data = substr($request->image_file, strpos($request->image_file, ',') + 1);
                $data = base64_decode($data);
                $imagePath = $request->nombre1.'_'.time().'.png';;
                Storage::disk('images')->put($imagePath, $data);
            }
            $persona->foto = $imagePath;
        }

        $alumno->save(); 

        return $this->showOne($alumno);
    }

    //eliminar registro a nivel logico
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return $this->showOne($alumno);
    }
}
