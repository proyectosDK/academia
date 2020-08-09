<?php

namespace App;

use App\Ciclo;
use App\Alumno;
use App\CursoInscripcion;
use App\InstitucionesEducativa;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripcions';

    protected $fillable = [
    	'ciclo_id',
    	'alumno_id',
    	'instituciones_educativa_id',
    	'fecha'
    ];

    public function institucion_educativa(){
    	return $this->belongsTo(InstitucionesEducativa::class);
    }

    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }

    public function ciclo(){
        return $this->belongsTo(Ciclo::class);
    }

    public function cursos(){
    	return $this->hasMany(CursoInscripcion::class);
    }
}
