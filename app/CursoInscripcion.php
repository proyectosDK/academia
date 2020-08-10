<?php

namespace App;

use App\Curso;
use App\NotasCurso;
use App\Inscripcion;
use Illuminate\Database\Eloquent\Model;

class CursoInscripcion extends Model
{
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
