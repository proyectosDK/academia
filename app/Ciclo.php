<?php

namespace App;

use App\Inscripcion;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $table = "ciclos";

    protected $fillable = [
    	'ciclo',
    	'inicio',
    	'fin',
    	'activo'
    ];

    public function inscripciones(){
    	return $this->hasMany(Inscripcion::class);
    }
}
