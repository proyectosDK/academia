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

//=====================ENCARGADOS==========================//
Route::get('encargadosView', 'Encargado\EncargadoController@view')->name('encargadosView');
Route::resource('encargados', 'Encargado\EncargadoController', ['except' => ['create', 'edit']]);

//=====================CICLOS==========================//
Route::get('ciclosView', 'Ciclo\CicloController@view')->name('ciclosView');
Route::resource('ciclos', 'Ciclo\CicloController', ['except' => ['create', 'edit']]);
Route::resource('ciclos.inscripciones', 'Ciclo\CicloInscripcionController', ['except' => ['create', 'edit']]);

//=====================ALUMNOS==========================//
Route::get('alumnosView', 'Alumno\AlumnoController@view')->name('alumnosView');
Route::resource('alumnos', 'Alumno\AlumnoController', ['except' => ['create', 'edit']]);

//=====================INSCRIPCIONES==========================//
Route::get('inscripcionsView', 'Inscripcion\InscripcionController@view')->name('inscripcionsView');
Route::resource('inscripcions', 'Inscripcion\InscripcionController', ['except' => ['create', 'edit']]);


//=====================NOTAS==========================//
Route::get('notasView', 'Nota\NotaController@view')->name('notasView');
Route::resource('notas', 'Nota\NotaController', ['except' => ['create', 'edit']]);

Route::get('tipoUsuariosView', 'TipoUsuario\TipoUsuarioController@view')->name('tipoUsuariosView');
Route::resource('tipoUsuarios', 'TipoUsuario\TipoUsuarioController', ['except' => ['create', 'edit']]);

Route::get('usersView', 'User\userController@view')->name('usersView');
Route::resource('users', 'User\userController', ['except' => ['create', 'edit']]);

Route::get('cambiarContrasenaView', 'User\userController@viewCambiarContraseña')->name('cambiarContrasenaView');
Route::name('cambiar_contraseña')->post('users_change_password','User\UserController@changePassword');