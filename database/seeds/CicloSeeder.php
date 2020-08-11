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
        for ($i=0; $i < 10 ; $i++) { 
            $data = new Ciclo;
            $data->ciclo = 2020 - $i;
            $data->inicio = $data->ciclo.'-01-01';
            $data->fin = $data->ciclo.'-10-24';
            $data->activo = False;
            if($data->ciclo == 2020) $data->activo = True;
            $data->save();
        }
    
    }
}
