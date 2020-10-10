<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bimestre extends Model
{
    protected $table = 'bimestres';
    protected $fillable= [
    	'nombre'
    ];
}
