<?php

namespace App\Http\Controllers\Nota;

use App\Nota;
use App\NotasCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $notas = Nota::with('bimestre','ciclo','notas_cursos.curso_inscripcion')->get();
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

            $nota = Nota::where('ciclo_id',$request->ciclo_id)->where('bimestre_id',$request->bimestre_id)->first();

            if(is_null($nota)){
                $data = $request->all();
                $nota = Nota::create($data); 
            }
            

            foreach ($request->notas as  $n) {
                $nota_curso = new NotasCurso;
                $nota_curso->nota_id = $nota->id;
                $nota_curso->cursos_inscripcion_id = $n['cursos_inscripcion_id'];
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
        $reglas = [
            'ciclo_id' =>'required|exists:ciclos,id',
            'bimestre_id' =>'required|exists:bimestres,id'
        ];
        
        $this->validate($request, $reglas);


        DB::beginTransaction();
            $nota->ciclo_id = $request->ciclo_id;
            $nota->bimestre = $request->bimestre_id;

            foreach ($request->notas as  $n) {
                $nota_curso = NotasCurso::find($n['id']);

                if($nota_curso !== $n['nota']){
                    $nota_curso->nota_id = $nota->id;
                    $nota_curso->cursos_inscripcion_id = $n['cursos_inscripcion_id'];
                    $nota_curso->nota = $n['nota'];

                    $nota_curso->save();    
                } 
            }

        DB::commit();
    }

    //eliminar registro a nivel logico
    public function destroy(Nota $nota)
    {
        $nota->delete();
        return $this->showOne($nota);
    }
}
