<?php

namespace App;

use App\Inscripcion;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Ciclo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
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
