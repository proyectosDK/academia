<?php

namespace App;

use App\Municipio;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{

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
