<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Departamento extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'departamentos';
    protected $fillable= [
    	'nombre'
    ];

    public function municipios(){
    	return $this->hasMany(Municipio::class);
    }
}
