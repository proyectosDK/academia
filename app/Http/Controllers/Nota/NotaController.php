<?php

namespace App\Http\Controllers\Nota;

use App\Nota;
use App\NotasCurso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class NotaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//retornar registro por id
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.notas.notas');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $notas = Nota::with('bimestre','ciclo','curso_nota')->get();
        return $this->showAll($notas);
    }

    //guardar un nuevo registro
    public function store(Request $request)
    {
        $reglas = [
            'ciclo_id' =>'required|exists:ciclos,id',
            'bimestre_id' =>'required|exists:bimestres,id'
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();
            $data = $request->all();
            $nota = Nota::create($data);

            foreach ($request->notas as  $n) {
                $nota_curso = new NotasCurso;
                $nota_curso->nota_id = $nota->id;
                $nota_curso->cursos_incripcion_id = $n['cursos_incripcion_id'];
                $nota_curso->nota = $n['nota'];

                $nota_curso->save();
            }

        DB::commit();

        return $this->showOne($nota,201);
    }

    //mostrar registro por id
    public function show(Nota $nota)
    {
        return $this->showOne($nota);
    }

    //actualizar registro
    public function update(Request $request, Nota $nota)
    {

    }

    //eliminar registro a nivel logico
    public function destroy(Nota $nota)
    {
        $nota->delete();
        return $this->showOne($nota);
    }
}
