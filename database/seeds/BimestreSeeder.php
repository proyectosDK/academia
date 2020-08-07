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
        $data->nombre = 'primer bimestre';
        $data->save();

        $data = new Bimestre();
        $data->nombre = 'segundo bimestre';
        $data->save();

        $data = new Bimestre();
        $data->nombre = 'tercer bimestre';
        $data->save();

        $data = new Bimestre();
        $data->nombre = 'cuarto bimestre';
        $data->save();
    }
}
