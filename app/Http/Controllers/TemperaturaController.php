<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class TemperaturaController extends Controller
{
    public static function cadastrar(Request $request){
        $tanque = \nemo\Tanque::find($request->id_tanque);
        $qualidade_agua = $tanque->qualidade_aguas;
        $temperatura = new \nemo\Temperatura();
        $temperatura->valor = $request->temperatura;
        $temperatura->data = $request->data;
        $temperatura->hora = $request->hora;
        $temperatura->qualidade_agua_id = $qualidade_agua->id;
        $temperatura->save();
  }

//   public function adicionar(Request $request){
      
//     $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
//     $tanque = \nemo\Tanque::find($request->id_tanque);
//     $temperatura = new \nemo\Temperatura();
//     $temperatura->valor = $request->valor;
//     $temperatura->data = $request->data;
//     $temperatura->hora = $request->hora;
//     $temperatura->qualidade_agua_id = $qualidade_agua->id;
//     $temperatura->save();
    
//     return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
//     }
}
