<?php

namespace App;

use App\Nota;
use App\CursosInscripcion;
use Illuminate\Database\Eloquent\Model;

class NotasCurso extends Model
{
    protected $table = 'notas_cursos';

    protected $fillable = [
    	'nota_id',
    	'cursos_incripcion_id'
    ];

    public function nota(){
    	return $this->belongsTo(Nota::class);
    }

    public function curso_inscripcion(){
    	return $this->belongsTo(CursosInscripcion::class);
    }

}
