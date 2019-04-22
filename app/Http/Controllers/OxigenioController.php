<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class OxigenioController extends Controller
{
    public static function cadastrar(Request $request){
        $tanque = \nemo\Tanque::find($request->id_tanque);
        $qualidade_agua = $tanque->qualidade_aguas;
        $oxigenio = new \nemo\NivelDeOxigenio();
        $oxigenio->valor = $request->oxigenio;
        $oxigenio->data = $request->data;
        $oxigenio->hora = $request->hora;
        $oxigenio->qualidade_agua_id = $qualidade_agua->id;
        $oxigenio->save();
  }

//   public function adicionar(Request $request){
      
//     $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
//     $tanque = \nemo\Tanque::find($request->id_tanque);
//     $oxigenio = new \nemo\NivelDeOxigenio();
//     $oxigenio->valor = $request->valor;
//     $oxigenio->data = $request->data;
//     $oxigenio->hora = $request->hora;
//     $oxigenio->qualidade_agua_id = $qualidade_agua->id;
//     $oxigenio->save();
    
//     return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
//     }
}
