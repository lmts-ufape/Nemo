<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class DurezaController extends Controller
{
    public static function cadastrar(Request $request){
        $tanque = \nemo\Tanque::find($request->id_tanque);
        $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
        $qualidade_agua = $ciclo->qualidade_agua;
        $dureza = new \nemo\Dureza();
        $dureza->valor = $request->dureza;
        $dureza->data = $request->data;
        $dureza->hora = $request->hora;
        $dureza->qualidade_agua_id = $qualidade_agua->id;
        $dureza->save();
  }

//   public function adicionar(Request $request){
      
//     $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
//     $tanque = \nemo\Tanque::find($request->id_tanque);
//     $dureza = new \nemo\Dureza();
//     $dureza->valor = $request->valor;
//     $dureza->data = $request->data;
//     $dureza->hora = $request->hora;
//     $dureza->qualidade_agua_id = $qualidade_agua->id;
//     $dureza->save();
    
//     return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
//     }
}
