<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class AmoniaController extends Controller
{
    public static function cadastrar(Request $request){
        $tanque = \nemo\Tanque::find($request->id_tanque);
        $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
        $qualidade_agua = $ciclo->qualidade_agua;
        $amonia = new \nemo\Amonia();
        $amonia->valor = $request->amonia;
        $amonia->data = $request->data;
        $amonia->hora = $request->hora;
        $amonia->qualidade_agua_id = $qualidade_agua->id;
        $amonia->save();
  }

//   public function adicionar(Request $request){
      
//     $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
//     $tanque = \nemo\Tanque::find($request->id_tanque);
//     $amonia = new \nemo\Amonia();
//     $amonia->valor = $request->valor;
//     $amonia->data = $request->data;
//     $amonia->hora = $request->hora;
//     $amonia->qualidade_agua_id = $qualidade_agua->id;
//     $amonia->save();
    
//     return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
//     }
}
