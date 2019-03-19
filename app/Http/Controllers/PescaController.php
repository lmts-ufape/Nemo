<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class PescaController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
  	}

    public function pesca($tanque_id, $especiePeixe_id,$povoamento_id){
  			$especiePeixe= \nemo\EspeciePeixe::find($especiePeixe_id); 
  			$povoamento= \nemo\Povoamento::find($povoamento_id);
			$tanque = \nemo\Tanque::find($tanque_id);
    		$idPiscultura = $tanque->piscicultura_id;
    		$piscicultura = \nemo\Piscicultura::find($idPiscultura);  
    		return view("pescarEspecie", ['especiePeixe' => $especiePeixe, 'especie_id' => $especiePeixe_id,'tanque'=>$tanque,'tanque_id' => $tanque_id,'piscicultura' => $piscicultura,'povoamento_id' => $povoamento->id]);
	}
	
	
	public function pescar(Request $request){	 			

                $tanque = \nemo\Tanque::find($request->id_tanque);
                $idPiscultura = $tanque->piscicultura_id;
    				 $piscicultura = \nemo\Piscicultura::find($idPiscultura);
                $povoamento = \nemo\Povoamento::find($request->id_povoamento);
                date_default_timezone_set('America/Sao_Paulo');
      			 $data = date('d-m-Y');
    				 $data .= ' '.date('H:i:s');
    				 
                                
                $pesca = \nemo\Pesca::create([
					 'tanque_id' => $request->id_tanque,       
					 'especie_id' => $request->id_especie,
					 'data' => $data,
                'quantidade' => $povoamento->quantidade,
                'peso' => $request->peso,
				       
        ]);
        
                
                $povoamento->delete();
                $povoamentos = \nemo\Povoamento::where('tanque_id','=',$request->id_tanque)->get();
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

    			
    		return view("infoTanque", ['tanque' => $tanque,'piscicultura'=>$piscicultura,'povoamentos'=>$povoamentosDic]);
    		}
    		
    
}
