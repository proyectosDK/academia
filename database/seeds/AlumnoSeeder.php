<?php

use App\Alumno;
use App\Inscripcion;
use App\CursosInscripcion;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for($i=0; $i<10; $i++){
            $data = new Alumno();
            $data->primer_nombre = 'nombre alumno '.$i;
            $data->primer_apellido = 'apellido alumno '.$i;
            $data->telefono = '5784789'.$i;
            $data->municipio_id = 1;
            $data->encargado_id = 1;
            $data->tipo_encargado = 'P';
            $data->direccion = 'calle 14 zona 3';
            $data->fecha_nac = '1992-03-05';
            $data->save(); 

            $ins = new Inscripcion;  
            $ins->ciclo_id = 1;
            $ins->alumno_id = $data->id;
            $ins->instituciones_educativa_id = 1;
            $ins->fecha = '2020-08-01';
            $ins->save();

            for ($j=1; $j<5; $j++){
                $cursos = new CursosInscripcion;
                $cursos->curso_id = $j;
                $cursos->inscripcion_id = $ins->id;
                $cursos->save();
            }
        }
    }
}
