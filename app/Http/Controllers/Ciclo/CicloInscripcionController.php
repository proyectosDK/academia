<?php

namespace App\Http\Controllers\Ciclo;

use App\Ciclo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CicloInscripcionController extends ApiController
{
    public function index(Ciclo $ciclo)
    {
        $inscripciones = $ciclo->inscripciones()->with('alumno','cursos')->get();
        return $this->showAll($inscripciones);
    }
}
