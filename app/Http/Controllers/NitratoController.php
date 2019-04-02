<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class NitratoController extends Controller
{
    public function cadastrar($qualidade_agua_id){
        $qualidade_agua = \nemo\QualidadeAgua::find($qualidade_agua_id);
        $tanque = \nemo\Tanque::find($qualidade_agua->tanque_id);
    	$piscicultura = $tanque->piscicultura;
    	  	
    	return view("cadastrarNitrato",['tanque_id'=>$tanque->tanque_id,'tanque' => $tanque,'piscicultura' => $piscicultura,'qualidade_agua' => $qualidade_agua]);
  }

  public function adicionar(Request $request){
      
    $qualidade_agua = \nemo\QualidadeAgua::find($request->id_qualidade_agua);
    $tanque = \nemo\Tanque::find($request->id_tanque);
    $nitrato = new \nemo\Nitrato();
    $nitrato->valor = $request->valor;
    $nitrato->data = $request->data;
    $nitrato->hora = $request->hora;
    $nitrato->qualidade_agua_id = $qualidade_agua->id;
    $nitrato->save();
    
    return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
      
    }
}
