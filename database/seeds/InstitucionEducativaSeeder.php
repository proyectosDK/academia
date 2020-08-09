<?php

use App\InstitucionesEducativa;
use Illuminate\Database\Seeder;

class InstitucionEducativaSeeder extends Seeder
{
    /**
     * Run the database seeds.

     'nombre',
    	'municipio_id',
    	'direccion',
    	'telefono',
    	'email'
     *
     * @return void
     */
    public function run()
    {
        //
        $data = new InstitucionesEducativa;
        $data->nombre = 'Colegio Ciudad Pedro de Alvarado';
        $data->municipio_id = 1;
        $data->telefono = '78458977';
        $data->email = 'col@col.com';
        $data->save();
    }
}
