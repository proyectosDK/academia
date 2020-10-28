<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Bimestre extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $table = 'bimestres';
    protected $fillable= [
    	'nombre'
    ];
}
