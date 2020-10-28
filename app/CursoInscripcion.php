<?php

namespace App;

use App\Curso;
use App\NotasCurso;
use App\Inscripcion;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CursoInscripcion extends Model implements Auditable
{ 
    use \OwenIt\Auditing\Auditable;
    protected $table = 'cursos_inscripcions';

    protected $fillable = [
    	'curso_id',
    	'inscripcion_id'
    ];

    public function curso(){
    	return $this->belongsTo(Curso::class);
    }

    public function inscripcion(){
    	return $this->belongsTo(Inscripcion::class);
    }

    public function notas(){
        return $this->hasMany(NotasCurso::class);
    }

    public function nota_curso(){
        return $this->hasMany(NotasCurso::class,'cursos_inscripcion_id');
    }
}
