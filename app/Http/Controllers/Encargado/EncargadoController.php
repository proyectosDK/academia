<?php

namespace App\Http\Controllers\Encargado;

use App\Encargado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class EncargadoController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//retornar registro por id
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.administracion.encargado');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $encargados = encargado::with('municipio.departamento')->get();
        return $this->showAll($encargados);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'cui'=> 'required|integer|unique:encargados',
            'primer_nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'municipio_id' =>'required|exists:municipios,id',
            'telefono' => 'required',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'fecha_nac' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $encargado = Encargado::create($data);

        return $this->showOne($encargado,201);
    }

    //mostrar registro por id
    public function show(Encargado $encargado)
    {
        return $this->showOne($encargado);
    }

    //actualizar registro
    public function update(Request $request, encargado $encargado)
    {
        $reglas = [
            'cui' => 'required|integer|unique:encargados,cui,' . $encargado->id,
            'primer_nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'municipio_id' =>'required|exists:municipios,id',
            'telefono' => 'required',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'fecha_nac' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $encargado->cui = $request->cui;
        $encargado->primer_nombre = $request->primer_nombre;
        $encargado->segundo_nombre = $request->segundo_nombre;
        $encargado->primer_apellido = $request->primer_apellido;
        $encargado->segundo_apellido = $request->segundo_apellido;
        $encargado->municipio_id = $request->municipio_id;
        $encargado->direccion = $request->direccion;
        $encargado->telefono = $request->telefono;
        $encargado->fecha_nac = $request->fecha_nac;

         if (!$encargado->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $encargado->save(); 

        return $this->showOne($encargado);
    }

    //eliminar registro a nivel logico
    public function destroy(Encargado $encargado)
    {
        $encargado->delete();
        return $this->showOne($encargado);
    }
}
