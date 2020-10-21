<?php

namespace App\Http\Controllers\Ciclo;

use App\Ciclo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CicloController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin')->except('index');
    }

    public function view()
    {
       return view('layout.administracion.ciclo');
    }

    public function index()
    {
        $ciclos = ciclo::all();
        return $this->showAll($ciclos);
    }

    public function store(Request $request)
    {
        $reglas = [
            'ciclo' => 'required',
            'inicio' => 'date|required',
            'fin' => 'date|required'
        ];
        
        $this->validate($request, $reglas);

        DB::table('ciclos')->where('activo', True)->update(array('activo' => False));

        $data = $request->all();

        $year = Carbon::now()->year;//obener año actual
        if($year == $request->ciclo) $data['activo'] = True;

        $ciclo = Ciclo::create($data);

        return $this->showOne($ciclo,201);
    }

    public function show()
    {
        
    }

    public function update(Request $request, Ciclo $ciclo)
    {
        $reglas = [
            'ciclo' => 'required',
            'inicio' => 'date|required',
            'fin' => 'date|required'
        ];


        $this->validate($request, $reglas);

        $year = Carbon::now()->year;

        DB::table('ciclos')->where('activo', True)->where('ciclo','!=',$year)->update(array('activo' => False));

        $year = Carbon::now()->year;
        if($year == $request->ciclo) $ciclo->activo = True;

        $ciclo->ciclo = $request->ciclo;
        $ciclo->inicio = $request->inicio;
        $ciclo->fin = $request->fin;

         if (!$ciclo->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $ciclo->save();
        return $this->showOne($ciclo);
    }

    public function destroy(Ciclo $ciclo)
    {
        $ciclo->delete();

        return $this->showOne($ciclo);
    }
}
