<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class PovoamentoController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
  	}
	
	 public function povoarTanque($tanque_id, $especie_id)
  {
  	$especiePeixe= \nemo\EspeciePeixe::find($especie_id); 
	$tanque = \nemo\Tanque::find($tanque_id);
  	$idPiscultura = $tanque->piscicultura_id;
   $piscicultura = \nemo\Piscicultura::find($idPiscultura); 
    return view("povoarTanque", ['tanque' => $tanque, 'especiePeixe' => $especiePeixe, 'piscicultura' => $piscicultura]);
  }
    public function inserirPeixe(Request $request){
		$tanque = \nemo\Tanque::find($request->id_tanque);			
		$especie = \nemo\EspeciePeixe::find($request->id_especie);
		$quantidadeAtual = $request->quantidade/$tanque->volume;
		if($request->warning == "1" || $quantidadeAtual <= $especie->quantidade_por_volume){
    		date_default_timezone_set('America/Sao_Paulo');
      		$data = date('d-m-Y');
    		$data .= ' '.date('H:i:s');
        	$povoamento = \nemo\Povoamento::create([
				'tanque_id' => $request->id_tanque,       
				'especie_id' => $request->id_especie,
				'data' => $data,
				'quantidade' => $request->quantidade,
				       
        	]);
        	return redirect()->route("listarTanques", ['id' => $tanque->piscicultura_id]);
    	
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
