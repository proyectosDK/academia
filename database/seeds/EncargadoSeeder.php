<?php

use App\Encargado;
use Illuminate\Database\Seeder;

class EncargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.

     *
     * @return void
     */
    public function run()
    {
        //
        $data = new Encargado();
        $data->id = 1;
        $data->cui = '457896541365';
        $data->nit = '4578967';
        $data->primer_nombre = 'Juan';
        $data->primer_apellido = 'Perez';
        $data->telefono = '57847899';
        $data->municipio_id = 1;
        $data->direccion = 'calle 14 zona 3';
        $data->fecha_nac = '1990-03-05';
        $data->save();
    }
}
