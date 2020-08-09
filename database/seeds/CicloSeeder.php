<?php

use App\Ciclo;
use Illuminate\Database\Seeder;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Ciclo;
        $data->ciclo = 2020;
        $data->inicio = '2020-01-01';
        $data->fin = '2020-10-24';
        $data->activo = True;
        $data->save();
    }
}
