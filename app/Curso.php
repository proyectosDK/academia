<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'cursos';
    protected $fillable= [
    	'nombre'
    ];
}
