<?php

use App\Bimestre;
use Illuminate\Database\Seeder;

class BimestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Bimestre();
        $data->id = 1;
        $data->nombre = 'primer bimestre';
        $data->save();

        $data = new Bimestre();
        $data->id = 2;
        $data->nombre = 'segundo bimestre';
        $data->save();

        $data = new Bimestre();
        $data->id = 3;
        $data->nombre = 'tercer bimestre';
        $data->save();

        $data = new Bimestre();
        $data->id = 4;
        $data->nombre = 'cuarto bimestre';
        $data->save();
    }
}
