<?php

namespace App\Http\Controllers\Nota;

use App\Alumno;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class BoletaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//retornar registro por id
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.notas.boleta');
    }

    //retorna todos los registros de la tabla
    public function index($alumno_id, $ciclo_id)
    {
    	$alumno = Alumno::find($alumno_id);

    	$inscripciones = $alumno->inscripciones;
    	$inscripcion = $inscripciones->where('ciclo_id',$ciclo_id)->first();

    	if(is_null($inscripcion)) return $this->errorResponse('alumno no inscrito en ciclo escolar seleccionado',422);

    	#dd($inscripcion->cursos()-);

    	$curso_notas = $inscripcion->cursos()->with('nota_curso.nota_c.bimestre','curso')->get();



        return $this->showAll($curso_notas);
    }
}
