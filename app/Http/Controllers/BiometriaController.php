<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;

class BiometriaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }
    
        public function cadastrar($tanque_id){
            $tanque = \nemo\Tanque::find($tanque_id);
            $idPiscultura = $tanque->piscicultura_id;
            $piscicultura = \nemo\Piscicultura::find($idPiscultura);
                  
            return view("cadastrarBiometria",['tanque_id'=>$tanque_id,'tanque' => $tanque,'piscicultura' => $piscicultura]);
      }
    
      public function adicionar(Request $request){
            $tanque = \nemo\Tanque::find($request->tanque_id);
            $biometria = new \nemo\Biometria();
            $biometria->peso_total = $request->peso;
            $biometria->peso_medio = $request->peso/$request->quantidade;
            $biometria->data = $request->data;
            $biometria->hora = $request->hora;
            $biometria->tanque_id = $tanque->id;
            $biometria->quantidade = $request->quantidade;
            $biometria->save();
            
             return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);

          }
}
