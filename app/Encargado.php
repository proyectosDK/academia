<?php

namespace App;

use App\Municipio;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Encargado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'encargados';
    protected $fillable = [
    	'cui',
    	'nit',
    	'primer_nombre',
    	'segundo_nombre',
    	'primer_apellido',
    	'segundo_apellido',
    	'telefono',
    	'municipio_id',
    	'direccion',
    	'fecha_nac'
    ];

    public function municipio(){
    	return $this->belongsTo(Municipio::class);
    }
}
