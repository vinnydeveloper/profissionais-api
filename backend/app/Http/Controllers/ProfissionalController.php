<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profissional;
use App\Tecnologia;
use DB;

class ProfissionalController extends Controller
{
    //

    public function listarProfissionais(Request $request){
        DB::enableQueryLog();
        $listaProfissionais = Profissional::find(16);
        $list = $listaProfissionais->tecnologias;
        //dd(DB::getQueryLog());

        dd($list);
        //return response()->json($listaProfissionais->tecnologias);
    }

    public function criarProfissional(Request $request){
        $tecnologiaId = $request->tecnologia;
        $newProfissional = new Profissional();
        $newProfissional->nome = $request->nome;
        $newProfissional->github = $request->github;
        $result = $newProfissional->save();
        $tecnologia = Tecnologia::find($tecnologiaId);
        if($tecnologia){
            $tecnologia->profissionais()->attach($newProfissional->id);
        }else {
            return response()->json(["error"=>"O id da tecnolgia não existe!"]);
        }
    

        return response()->json($newProfissional);
    }
}
