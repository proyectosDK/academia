<?php

namespace App;

use App\Inscripcion;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';

    protected $fillable = [
        'foto',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'municipio_id',
        'encargado_id',
        'tipo_encargado',
        'direccion',
        'fecha_nac',
        'telefono'
    ];

    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }

    public function encargado(){
        return $this->belongsTo(Encargado::class);
    }

    public function inscripciones(){
        return $this->hasMany(Inscripcion::class);
    }
}
