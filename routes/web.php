<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('cursosView', 'Curso\CursoController@view')->name('cursosView');
Route::resource('cursos', 'Curso\CursoController', ['except' => ['create', 'edit']]);

Route::get('bimestresView', 'Bimestre\BimestreController@view')->name('bimestresView');
Route::resource('bimestres', 'Bimestre\BimestreController', ['except' => ['create', 'edit']]);

//=====================DEPARTAMENTOS DE GUATEMALA==========================//
Route::get('departamentosView', 'Departamento\DepartamentoController@view')->name('departamentosView');
Route::resource('departamentos', 'Departamento\DepartamentoController', ['except' => ['create', 'edit']]);
//=====================MUNICIPIOS DE GUATEMALA==========================//
Route::get('municipiosView', 'Municipio\MunicipioController@view')->name('municipiosView');
Route::resource('municipios', 'Municipio\MunicipioController', ['except' => ['create', 'edit']]);

//=====================INSTITUCIONES EDUCATIVAS==========================//
Route::get('institucionesView', 'InstitucionEducativa\InstitucionEducativaController@view')->name('institucionesView');
Route::resource('institucionesEducativas', 'InstitucionEducativa\InstitucionEducativaController', ['except' => ['create', 'edit']]);

Route::get('tipoUsuariosView', 'TipoUsuario\TipoUsuarioController@view')->name('tipoUsuariosView');
Route::resource('tipoUsuarios', 'TipoUsuario\TipoUsuarioController', ['except' => ['create', 'edit']]);

Route::get('usersView', 'User\userController@view')->name('usersView');
Route::resource('users', 'User\userController', ['except' => ['create', 'edit']]);

Route::get('cambiarContrasenaView', 'User\userController@viewCambiarContraseña')->name('cambiarContrasenaView');
Route::name('cambiar_contraseña')->post('users_change_password','User\UserController@changePassword');