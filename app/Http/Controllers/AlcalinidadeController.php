<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class AlcalinidadeController extends Controller
{
    public static function cadastrar(Request $request){
        $tanque = \nemo\Tanque::find($request->id_tanque);
        $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
        $qualidade_agua = $ciclo->qualidade_agua;
        $alcalinidade = new \nemo\Alcalinidade();
        $alcalinidade->valor = $request->alcalinidade;
        $alcalinidade->data = $request->data;
        $alcalinidade->hora = $request->hora;
        $alcalinidade->qualidade_agua_id = $qualidade_agua->id;
        $alcalinidade->save();
  }

//   public function adicionar(Request $request){
      
//     $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
//     $tanque = \nemo\Tanque::find($request->id_tanque);
//     $alcalinidade = new \nemo\Alcalinidade();
//     $alcalinidade->valor = $request->valor;
//     $alcalinidade->data = $request->data;
//     $alcalinidade->hora = $request->hora;
//     $alcalinidade->qualidade_agua_id = $qualidade_agua->id;
//     $alcalinidade->save();
    
//     return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
//     }
}
