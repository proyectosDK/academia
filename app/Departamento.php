<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //use \OwenIt\Auditing\Auditable;

    protected $table = 'departamentos';
    protected $fillable= [
    	'nombre'
    ];
}
