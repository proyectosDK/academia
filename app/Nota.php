<?php

namespace App;

use App\Bimestre;
use App\NotasCurso;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';

    protected $fillable = [
    	'ciclo_id',
    	'bimestre_id'
    ];

    public function ciclo(){
    	return $this->belongsTo(Ciclo::class);
    }

    public function bimestre(){
    	return $this->belongsTo(Bimestre::class);
    }

    public function notas_cursos(){
        return $this->hasMany(NotasCurso::class);
    }
}
