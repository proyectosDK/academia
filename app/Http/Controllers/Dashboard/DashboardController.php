<?php

namespace App\Http\Controllers\Dashboard;

use App\Ciclo;
use App\Curso;
use App\Alumno;
use App\Encargado;
use Carbon\Carbon;
use App\Inscripcion;
use Illuminate\Http\Request;
use App\InstitucionesEducativa;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class DashboardController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('admin')->except(['index']);
    }

    public function info()
    {
    	$alumnos = Alumno::all()->count();
    	$year = Carbon::now()->year;
       	$ciclo = Ciclo::where('ciclo',$year)->first();
        $inscripciones = $ciclo->inscripciones()->count();	
        $instituciones = InstitucionesEducativa::all()->count();
        $encargados = Encargado::all()->count();


        return response()->json([
        	'alumnos'=>$alumnos,
        	'inscripciones'=>$inscripciones,
        	'instituciones'=>$instituciones,
        	'encargados'=>$encargados
        	], 200);
    }

    public function resumenCiclos()
    {
       $labels = array();
       $values = array();

       $ciclos = Ciclo::latest()->take(10)->get();

       foreach ($ciclos as $c) {
       		$inscripciones = Inscripcion::where('ciclo_id',$c->id)->count();
       		array_push($labels, $c->ciclo);
       		array_push($values, $inscripciones);
       }

       return response()->json(['info'=>$values,'labels'=>$labels], 200);
    }

    public function resumenCursos()
    {
       $labels = array();
       $values = array();

       $year = Carbon::now()->year;
       $ciclo = Ciclo::where('ciclo',$year)->first();
       $cursos = Curso::all();

       $inscripciones = $ciclo->inscripciones()->with('cursos.curso')->get()->pluck('cursos')->collapse()->values();

       foreach ($cursos as $c) {
       		$cant = count($inscripciones->where('curso_id',$c->id));
       		array_push($labels, $c->nombre);
       		array_push($values, $cant);
       }

       return response()->json(['info'=>$values,'labels'=>$labels], 200);
    }

    public function resumenInstituciones()
    {
       $labels = array();
       $values = array();

       $instituciones = InstitucionesEducativa::all();

       foreach ($instituciones as $c) {
       		$alumnos = Inscripcion::where('instituciones_educativa_id',$c->id)->count();
       		array_push($labels, $c->nombre);
       		array_push($values, $alumnos);
       }

       return response()->json(['info'=>$values,'labels'=>$labels], 200);
    }

}
