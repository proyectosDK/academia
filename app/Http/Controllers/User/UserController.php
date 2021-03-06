<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class UserController extends ApiController
{
   public function __construct()
    {
        parent::__construct();//retornar registro por id
        $this->middleware('admin')->except('viewCambiarContraseña','changePassword');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.acceso.user');
    }

    public function viewCambiarContraseña()
    {
       return view('layout.acceso.cambiarContrasena');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $users = User::with('tipo_usuario')->get();
        return $this->showAll($users);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'email'=> 'required|email|unique:users',
            'password' => 'required', 'string', 'min:6', 'confirmed',
            'tipo_usuario_id' =>'required|exists:tipo_usuarios,id'
        ];
        
        $this->validate($request, $reglas);

        $imagePath = '';
        if (preg_match('/^data:image\/(\w+);base64,/', $request->image_file)) {
            $data = substr($request->image_file, strpos($request->image_file, ',') + 1);
            $data = base64_decode($data);
            $imagePath = 'users/'.$request->codigo.'_'.time().'.png';;
            Storage::disk('images')->put($imagePath, $data);
        }

        $data = $request->all();
        $data['avatar'] = $imagePath;
        $data['password'] = bcrypt($request->password);
        $data['email'] = $request->email;

        $user = User::create($data);

        return $this->showOne($user,201);
    }

    //mostrar registro por id
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    //actualizar registro
    public function update(Request $request, User $user)
    {
        $reglas = [
            'tipo_usuario_id' =>'required|exists:tipo_usuarios,id',
            'email' => 'required|string|unique:users,email,' . $user->id,
        ];

        $this->validate($request, $reglas);

        if($request->image_file != null || $request->image_file != ''){
            $imagePath = '';
            if (preg_match('/^data:image\/(\w+);base64,/', $request->image_file)) {
                $data = substr($request->image_file, strpos($request->image_file, ',') + 1);
                $data = base64_decode($data);
                $imagePath = 'users/'.$request->nombre1.'_'.time().'.png';;
                Storage::disk('images')->put($imagePath, $data);
            }
            $user->avatar = $imagePath;
        }

        $user->tipo_usuario_id = $request->tipo_usuario_id;
        $user->email = $request->email;

        $user->save();  

        return $this->showOne($user);
    }

    //eliminar registro a nivel logico
    public function destroy(User $user)
    {
        $user->delete(); 

        return $this->showOne($user);
    }

    //funcion para cambiar contraseña
    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $reglas = [
            'password' => 'required', 'string', 'min:6', 'confirmed',
        ];
        
        $this->validate($request, $reglas);

        if (Hash::check($request->password, $user->password)) {
            return $this->errorResponse('la contraseña actual no puede ser igual a la nueva contraseña',422);
        }

        if (Hash::check($request->old_password, $user->password)) { 
            $user->password = bcrypt($request->password);
            $user->save();
        } else {
            return $this->errorResponse('la contraseña anterior es incorrecta',422);
        }


        return $this->showOne($user,'201','update');
    }
}
