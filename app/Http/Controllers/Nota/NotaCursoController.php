<?php

namespace App\Http\Controllers\Nota;

use App\Nota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class NotaCursoController extends ApiController
{
    /**
     */
    public function index(Nota $nota)
    {
        $notas_cursos = $nota->notas_cursos()->with('curso_inscripcion.curso','curso_inscripcion.inscripcion.alumno')->get();

        return $this->showAll($notas_cursos);
    }

}
