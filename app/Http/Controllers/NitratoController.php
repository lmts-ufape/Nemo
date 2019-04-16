<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class NitratoController extends Controller
{
    public static function cadastrar(Request $request){
        $tanque = \nemo\Tanque::find($request->id_tanque);
        $qualidade_agua = $tanque->qualidade_aguas;
        $nitrato = new \nemo\Nitrato();
        $nitrato->valor = $request->nitrato;
        $nitrato->data = $request->data;
        $nitrato->hora = $request->hora;
        $nitrato->qualidade_agua_id = $qualidade_agua->id;
        $nitrato->save();
  }
    

//   public function adicionar(Request $request){
      
//     $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
//     $tanque = \nemo\Tanque::find($request->id_tanque);
//     $nitrato = new \nemo\Nitrato();
//     $nitrato->valor = $request->valor;
//     $nitrato->data = $request->data;
//     $nitrato->hora = $request->hora;
//     $nitrato->qualidade_agua_id = $qualidade_agua->id;
//     $nitrato->save();
    
//     return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
//     }
}
