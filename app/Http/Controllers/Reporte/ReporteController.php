<?php

namespace App\Http\Controllers\Reporte;

use App\Ciclo;
use App\Alumno;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ReporteController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('admin')->except(['index']);
    }

    public function view()
    {
       return view('layout.consultas.consulta');
    }

    public function getInscripciones(Ciclo $ciclo, $ciclo_id)
    {
    	$ciclo = Ciclo::find($ciclo_id);
    	$inscripciones = $ciclo->inscripciones()->with('alumno','cursos.curso','institucion_educativa')->get();

    	//una sola linea
    	foreach ($inscripciones as $i) {
    		$nombres = $i->alumno->primer_nombre.' '.$i->alumno->segundo_nombre.' '.$i->alumno->primer_apellido.' '.$i->alumno->segundo_apellido;

    		$i->nombres = $nombres;
    		$i->codigo_alumno = $i->alumno->id;
    		$i->cursos_asignados = "";
    		foreach ($i->cursos as $c) {
    			$i->cursos_asignados = $i->cursos_asignados.' '.$c->curso->nombre.', ';
    		}

    		$i->institucion = $i->institucion_educativa->nombre;

    		$i->cursos_asignados = substr($i->cursos_asignados, 0, -2);
    	}

    	return $inscripciones;
    }

    public function inscripcionesByCiclo($ciclo_id){
    	$ciclo = Ciclo::find($ciclo_id);
    	$inscripciones = $this->getInscripciones($ciclo,$ciclo_id);

    	return $this->showAll($inscripciones);
    }

    //Funciones para crear el reporte e imprimir inscripciones
    public function printInscripciones($ciclo_id = 1)
    {
    	$ciclo = Ciclo::find($ciclo_id);
        $inscripciones = $this->getInscripciones($ciclo,$ciclo_id);

        $pdf = PDF::loadView('layout.consultas.inscripcion_pdf', compact('ciclo', 'inscripciones'))->setPaper('a4', 'landscape');

        return $pdf->stream('inscripciones_'.$ciclo->ciclo.'.pdf');
    }

    //Funciones para crear el reporte e imprimir alumnnos
    public function printAlumnos()
    {
    	$alumnos = Alumno::with('encargado','municipio.departamento')->get();

    	foreach ($alumnos as $i) {
    		$nombres = $i->primer_nombre.' '.$i->segundo_nombre.' '.$i->primer_apellido.' '.$i->segundo_apellido;

    		$i->nombres = $nombres;
    		$i->nombre_encargado = $i->encargado->primer_nombre.' '.$i->encargado->segundo_nombre.' '.$i->encargado->primer_apellido.' '.$i->encargado->segundo_apellido;
    		$i->direccion = $i->direccion.' '.$i->municipio->nombre. ' '.$i->municipio->departamento->nombre;
    		$i->telefono_encargado = $i->encargado->telefono;
    	}

        $pdf = PDF::loadView('layout.consultas.alumnos_pdf', compact('alumnos'))->setPaper('a4', 'landscape');

        return $pdf->stream('alumnos.pdf');
    }
}
