<?php

use App\Curso;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Curso();
        $data->id = 1;
        $data->nombre = 'programacion';
        $data->save();

        $data = new Curso();
        $data->id = 2;
        $data->nombre = 'mecanografia';
        $data->save();

        $data = new Curso();
        $data->id = 3;
        $data->nombre = 'computacion';
        $data->save();

        $data = new Curso();
        $data->id = 4;
        $data->nombre = 'mantenimiento y reparacion de computadoras';
        $data->save();
    }
}
