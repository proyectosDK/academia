<?php

namespace App\Http\Controllers\InstitucionEducativa;

use Illuminate\Http\Request;
use App\InstitucionesEducativa;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class InstitucionEducativaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//retornar registro por id
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.catalogos.institucionEducativa');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $institucionesEducativas = InstitucionesEducativa::with('municipio.departamento')->get();
        return $this->showAll($institucionesEducativas);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string',
            'municipio_id' =>'required|exists:municipios,id',
            'telefono' => 'required'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $institucionesEducativa = InstitucionesEducativa::create($data);

        return $this->showOne($institucionesEducativa,201);
    }

    //mostrar registro por id
    public function show(InstitucionesEducativa $institucionesEducativa)
    {
        return $this->showOne($institucionesEducativa);
    }

    //actualizar registro
    public function update(Request $request, InstitucionesEducativa $institucionesEducativa)
    {
        $reglas = [
            'nombre' => 'required|string',
            'municipio_id' =>'required|exists:municipios,id',
            'telefono' => 'required'
        ];

        $this->validate($request, $reglas);

        $institucionesEducativa->nombre = $request->nombre;
        $institucionesEducativa->municipio_id = $request->municipio_id;
        $institucionesEducativa->direccion = $request->direccion;
        $institucionesEducativa->telefono = $request->telefono;
        $institucionesEducativa->email = $request->email;

         if (!$institucionesEducativa->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $institucionesEducativa->save(); 

        return $this->showOne($institucionesEducativa);
    }

    //eliminar registro a nivel logico
    public function destroy(InstitucionesEducativa $institucionesEducativa)
    {
        $institucionesEducativa->delete();

        return $this->showOne($institucionesEducativa);
    }
}
