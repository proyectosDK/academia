<?php

namespace App\Http\Controllers\Curso;

use App\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CursoController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin')->except('index');
    }

    public function view()
    {
       return view('layout.catalogos.curso');
    }

    public function index()
    {
        $cursos = Curso::all();
        return $this->showAll($cursos);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $curso = Curso::create($data);

        return $this->showOne($curso,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Curso $curso)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $curso->nombre = $request->nombre;

         if (!$curso->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $curso->save();
        return $this->showOne($curso);
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return $this->showOne($curso);
    }
}
