<?php

use nemo\Tanque;

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class TanqueController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function listar($id)
  {
    $tanques = \nemo\Tanque::where('piscicultura_id','=',$id)->get();
    $piscicultura = \nemo\Piscicultura::find($id);
    return view('listarTanques', ['tanques' => $tanques, 'piscicultura' => $piscicultura]);
  
  }

  public function cadastrar($id)
  {
    $piscicultura = \nemo\Piscicultura::find($id);
    return view("cadastrarTanque", ['piscicultura' => $piscicultura]);
  }

  public function adicionar(Request $request){

    $piscicultura = \nemo\Piscicultura::find($request->id_piscicultura);
    $piscicultura->tanques()->create([
      'nome' => $request->nome,
      'volume' => $request->volume,
      'area' => $request->area,
      'altura' => $request->altura,
      'manutencao_necessaria' => 'Não'
      ]);
      return redirect()->route("listarTanques", ['piscicultura' => $request->id_piscicultura]);
      
  }

  public function editar($id) {
    $tanque = \nemo\Tanque::find($id);
    $piscicultura = $tanque->piscicultura;
    return view("editarTanque", [
      'tanque' => $tanque,
      'piscicultura' => $piscicultura,
    ]);
  }

  public function salvar(Request $request){
	 	$tanque = \nemo\Tanque::find($request->id);
    $tanque->volume = $request->volume;
    $tanque->nome = $request->nome;
    $tanque->altura = $request->altura;
    $tanque->area = $request->area;
    $tanque->manutencao_necessaria = $request->manutencao_necessaria;
    $tanque->update();
    return redirect()->route("detalhesTanque", ['id' => $tanque->piscicultura_id]);
    
  }

  public function remover(Request $request){
    $tanque = \nemo\Tanque::find($request->id);
    $piscicultura = \nemo\Piscicultura::find($tanque->piscicultura_id);
  	return view("/removerTanque", ['tanque' => $tanque, 'piscicultura' => $piscicultura]);
	}

	public function apagar(Request $request){
  	$tanque = \nemo\Tanque::find($request->tanque_id);
    $tanque->delete();
    return redirect()->route("listarTanques", ['id' => $tanque->piscicultura_id]);
  }
  
  public function exibirDetalhes($id) {
    $tanque = \nemo\Tanque::find($id);
    $piscicultura = $tanque->piscicultura;
    return view("detalhesTanque", [
      'tanque' => $tanque,
      'piscicultura' => $piscicultura,
    ]);
  }
}
