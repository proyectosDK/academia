<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
       $data = new User();
       $data->email = 'admin@admin.com';
       $data->password = bcrypt('administrador');
       $data->tipo_usuario_id = 1;
       $data->avatar = '_1597084527.png';
       $data->save();

       $data = new User();
       $data->email = 'secretaria@secretaria.com';
       $data->password = bcrypt('secretaria');
       $data->tipo_usuario_id = 2;
       $data->save();
    }
}
