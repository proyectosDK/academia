<?php

namespace App;

use App\Nota;
use App\CursosInscripcion;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class NotasCurso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'notas_cursos';

    protected $fillable = [
    	'nota_id',
    	'cursos_inscripcion_id'
    ];

    //relación tabla notas
    public function nota_c(){
    	return $this->belongsTo(Nota::class,'nota_id');
    }

    public function curso_inscripcion(){
    	return $this->belongsTo(CursoInscripcion::class,'cursos_inscripcion_id');
    }

}
