<?php

use Illuminate\Database\Seeder;
use App\Imports\DepartamentoImport;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$datas = Excel::import(new DepartamentoImport, 'database/seeds/Departamentos.xlsx', null, \Maatwebsite\Excel\Excel::XLSX);
    }
}
