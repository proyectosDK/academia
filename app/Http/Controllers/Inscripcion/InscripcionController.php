<?php

namespace App\Http\Controllers\Inscripcion;

use App\Inscripcion;
use App\CursoInscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class InscripcionController extends ApiController
{
   public function __construct()
    {
        parent::__construct();//retornar registro por id
        //$this->middleware('admin')->except('index');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.administracion.inscripcion');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $inscripcions = Inscripcion::with('alumno','ciclo','cursos.curso')->get();
        return $this->showAll($inscripcions);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'ciclo_id' =>'required|exists:ciclos,id',
            'alumno_id' =>'required|exists:alumnos,id',
            'instituciones_educativa_id' =>'required|exists:instituciones_educativas,id',
            'fecha' => 'required'
        ];
        
        $this->validate($request, $reglas);

        $exists = Inscripcion::where('alumno_id',$request->alumno_id)->where('ciclo_id',$request->ciclo_id)->get();

        if (count($exists)) return $this->errorResponse('alumno ya fue inscrito a ciclo escolar seleccionado ',422);

        DB::beginTransaction();
            $data = $request->all();
            $inscripcion = Inscripcion::create($data);

            foreach ($request->cursos as  $cur) {
                $curso = new CursoInscripcion;
                $curso->inscripcion_id = $inscripcion->id;
                $curso->curso_id = $cur;

                $curso->save();
            }

        DB::commit();

        return $this->showOne($inscripcion,201);
    }

    //mostrar registro por id
    public function show(inscripcion $inscripcion)
    {
        return $this->showOne($inscripcion);
    }

    //actualizar registro
    public function update(Request $request, Inscripcion $inscripcion)
    {
        $reglas = [
            'ciclo_id' =>'required|exists:ciclos,id',
            'alumno_id' =>'required|exists:alumnos,id',
            'instituciones_educativa_id' =>'required|exists:instituciones_educativas,id',
            'fecha' => 'required'
        ];

        $this->validate($request, $reglas);

        if($inscripcion->ciclo_id != $request->ciclo_id){
            $exists = Inscripcion::where('alumno_id',$request->alumno_id)->where('ciclo_id',$request->ciclo_id)->get();

            if (count($exists)) return $this->errorResponse('alumno ya fue inscrito a ciclo escolar seleccionado ',422);
        }

        

        $inscripcion->ciclo_id = $request->ciclo_id;
        $inscripcion->alumno_id = $request->alumno_id;
        $inscripcion->instituciones_educativa_id = $request->instituciones_educativa_id;

        $inscripcion->cursos()->delete(); //eliminamos los anteriores

        foreach ($request->cursos as  $cur) {
            $curso = new CursoInscripcion;
            $curso->inscripcion_id = $inscripcion->id;
            $curso->curso_id = $cur;

            $curso->save();
        }

        $inscripcion->save(); 

        return $this->showOne($inscripcion);
    }

    //eliminar registro a nivel logico
    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();

        return $this->showOne($inscripcion);
    }
}
