<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class DurezaController extends Controller
{
    public function cadastrar($qualidade_agua_id){
        $qualidade_agua = \nemo\QualidadeAgua::find($qualidade_agua_id);
        $tanque = \nemo\Tanque::find($qualidade_agua->tanque_id);
    	$piscicultura = $tanque->piscicultura;
    	  	
    	return view("cadastrarDureza",['tanque_id'=>$tanque->tanque_id,'tanque' => $tanque,'piscicultura' => $piscicultura,'qualidade_agua' => $qualidade_agua]);
  }

  public function adicionar(Request $request){
      
    $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
    $tanque = \nemo\Tanque::find($request->id_tanque);
    $dureza = new \nemo\Dureza();
    $dureza->valor = $request->valor;
    $dureza->data = $request->data;
    $dureza->hora = $request->hora;
    $dureza->qualidade_agua_id = $qualidade_agua->id;
    $dureza->save();
    
    return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
    }
}
