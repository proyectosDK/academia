<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Municipio extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $table = 'municipios';
    protected $fillable= [
    	'nombre',
    	'departamento_id'
    ];

    public function departamento()
    {
    	return $this->belongsTo(Departamento::class);
    }
}
