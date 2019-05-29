<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class NitritoController extends Controller
{
    public static function cadastrar(Request $request){
        $tanque = \nemo\Tanque::find($request->id_tanque);
        $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
        $qualidade_agua = $ciclo->qualidade_agua;
        $nitrito = new \nemo\Nitrito();
        $nitrito->valor = $request->nitrito;
        $nitrito->data = $request->data;
        $nitrito->hora = $request->hora;
        $nitrito->qualidade_agua_id = $qualidade_agua->id;
        $nitrito->save();
  }

//   public function adicionar(Request $request){
      
//     $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
//     $tanque = \nemo\Tanque::find($request->id_tanque);
//     $nitrito = new \nemo\Nitrito();
//     $nitrito->valor = $request->valor;
//     $nitrito->data = $request->data;
//     $nitrito->hora = $request->hora;
//     $nitrito->qualidade_agua_id = $qualidade_agua->id;
//     $nitrito->save();
    
//     return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
//     }
}
