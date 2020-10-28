<?php

use Illuminate\Database\Seeder;
use App\Imports\MunicipioImport;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = Excel::import(new MunicipioImport, 'database/seeds/Municipios.xlsx', null, \Maatwebsite\Excel\Excel::XLSX);
    }
}
