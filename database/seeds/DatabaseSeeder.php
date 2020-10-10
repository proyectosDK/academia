<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(TipoUsuarioSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(BimestreSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(EncargadoSeeder::class);
        $this->call(CicloSeeder::class);
        $this->call(InstitucionEducativaSeeder::class);
        $this->call(AlumnoSeeder::class);   
    }
}
