<?php

namespace App;

use App\Ciclo;
use App\Alumno;
use App\CursoInscripcion;
use App\InstitucionesEducativa;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Inscripcion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'inscripcions';

    protected $fillable = [
    	'ciclo_id',
    	'alumno_id',
    	'instituciones_educativa_id',
    	'fecha'
    ];

    public function institucion_educativa(){
    	return $this->belongsTo(InstitucionesEducativa::class, 'instituciones_educativa_id');
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
