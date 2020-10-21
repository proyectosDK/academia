<?php

use App\Nota;
use App\Ciclo;
use App\Alumno;
use App\NotasCurso;
use App\Inscripcion;
use App\CursoInscripcion;
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
        //insertar notas.

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

            $ciclos = Ciclo::All()->random(rand(6,10));

            foreach ($ciclos as $c) {
                $ins = new Inscripcion;  
                $ins->ciclo_id = $c->id;
                $ins->alumno_id = $data->id;
                $ins->instituciones_educativa_id = 1;
                $ins->fecha = $c->ciclo.'-08-01';
                $ins->save();

                for ($j=1; $j<5; $j++){
                    $cursos = new CursoInscripcion;
                    $cursos->curso_id = $j;
                    $cursos->inscripcion_id = $ins->id;
                    $cursos->save();
                }
            }
        }

        for($i=1; $i<=2; $i++){
            $nota = new Nota;
            $nota->ciclo_id = 1;
            $nota->bimestre_id =$i; 
            $nota->save();

            $inscripciones = CursoInscripcion::all();

            foreach ($inscripciones as $ins) {
                $nota_bimestre = new NotasCurso;
                $nota_bimestre->nota_id = $nota->id;
                $nota_bimestre->cursos_inscripcion_id = $ins->id;
                $nota_bimestre->nota = rand(40,100);
                $nota_bimestre->save();
            }
        }
    }
}
