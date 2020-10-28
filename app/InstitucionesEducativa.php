<?php

namespace App;

use App\Municipio;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class InstitucionesEducativa extends Model implements Auditable
{

	use \OwenIt\Auditing\Auditable;

    protected $table = "instituciones_educativas";
    protected $fillable = [
    	'nombre',
    	'municipio_id',
    	'direccion',
    	'telefono',
    	'email'
    ];

    public function municipio()
    {
    	return $this->belongsTo(Municipio::class);
    }
}
