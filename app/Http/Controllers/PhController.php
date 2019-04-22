<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class PhController extends Controller
{
    public static function cadastrar(Request $request){
        $tanque = \nemo\Tanque::find($request->id_tanque);
        $qualidade_agua = $tanque->qualidade_aguas;
        $ph = new \nemo\Ph();
        $ph->valor = $request->ph;
        $ph->data = $request->data;
        $ph->hora = $request->hora;
        $ph->qualidade_agua_id = $qualidade_agua->id;
        $ph->save();
  }

//   public function adicionar(Request $request){
      
//     $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
//     $tanque = \nemo\Tanque::find($request->id_tanque);
//     $ph = new \nemo\Ph();
//     $ph->valor = $request->valor;
//     $ph->data = $request->data;
//     $ph->hora = $request->hora;
//     $ph->qualidade_agua_id = $qualidade_agua->id;
//     $ph->save();
    
//     return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
//     }
}
