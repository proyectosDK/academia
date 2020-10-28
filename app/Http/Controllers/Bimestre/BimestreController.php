<?php

namespace App\Http\Controllers\Bimestre;

use App\Bimestre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class BimestreController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin')->except('index');
    }

    public function view()
    {
       return view('layout.catalogos.bimestre');
    }

    public function index()
    {
        $bimestres = Bimestre::all();
        return $this->showAll($bimestres);
    }

    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $bimestre = bimestre::create($data);

        return $this->showOne($bimestre,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Bimestre $bimestre)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $bimestre->nombre = $request->nombre;

         if (!$bimestre->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $bimestre->save();
        return $this->showOne($bimestre);
    }

    public function destroy(Bimestre $bimestre)
    {
        $bimestre->delete();

        return $this->showOne($bimestre);
    }
}
