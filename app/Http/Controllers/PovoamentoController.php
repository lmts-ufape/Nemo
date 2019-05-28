<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;
use nemo\Tanque;
use nemo\Http\Controllers\BiometriaController;

class PovoamentoController extends Controller{

	public function __construct(){
		$this->middleware('auth');
  	}
	
	 public function povoarTanque($tanque_id, $especie_id)
  {
		$tanque = \nemo\Tanque::find($tanque_id);
		if($tanque->status != "livre"){
			return back();
		}
  	$especiePeixe= \nemo\EspeciePeixe::find($especie_id); 
  	$idPiscultura = $tanque->piscicultura_id;
	 $piscicultura = \nemo\Piscicultura::find($idPiscultura); 
	 date_default_timezone_set('America/Sao_Paulo');
      $data = date('Y-m-d');
      $hora = date('H:i');
    return view("povoarTanque", ['data_atual'=>$data,'hora_atual'=>$hora,'tanque' => $tanque, 'especiePeixe' => $especiePeixe, 'piscicultura' => $piscicultura]);
  }
    public function inserirPeixe(Request $request){
		$tanque = \nemo\Tanque::find($request->id_tanque);
		$ciclo = $tanque->ciclos[count($tanque->ciclos)-1];	
		$especie = \nemo\EspeciePeixe::find($request->id_especie);
		$quantidadeAtual = $request->quantidade/$tanque->volume;
		if($request->warning == "1" || $quantidadeAtual <= $especie->quantidade_por_volume){
			
			date_default_timezone_set('America/Sao_Paulo');
			$data = date('d-m-Y');
			$data .= ' '.date('H:i:s');
			//dd($ciclo->id);	
        	$povoamento = \nemo\Povoamento::create([
				'ciclo_id' => $ciclo->id,       
				'especie_id' => $request->id_especie,
				'data' => $request->data,
				'quantidade' => $request->quantidade,
				       
					]);
					BiometriaController::adicionar($request);
					$tanque->status = "producao";
					$tanque->update();
					
					
        	return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
    	
		}else{
			return back()->withErrors(array('message' => 'Quantidade inserida maior do que a capacidade do tanque. Se deseja realizar o povoamento mesmo assim insira novamente.'));
		}
		
    }
    public function listar ($id) {
    		$tanque = \nemo\Tanque::find($id);
    		$idPiscultura = $tanque->piscicultura_id;
    		$piscicultura = \nemo\Piscicultura::find($idPiscultura);
    		
			$povoamentos = \nemo\Povoamento::where('tanque_id','=',$id)->get();

			$povoamentosDic = array();

			foreach ($povoamentos as &$povoamento) {
				$especiePeixe= \nemo\EspeciePeixe::find($povoamento->especie_id);
				try {
					array_push($povoamentosDic[$especiePeixe->nome], $povoamento);				
				}catch(\Exception $e){
					$povoamentosDic[$especiePeixe->nome] = array();
					array_push($povoamentosDic[$especiePeixe->nome], $povoamento);
				}
			}
			
			

			
			
    		return view('infoTanque', ['povoamentos' => $povoamentosDic,'tanque' => $tanque,'piscicultura' => $piscicultura]);
    		   	
    }
}
