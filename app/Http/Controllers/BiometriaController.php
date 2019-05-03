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
          $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
          if($ciclo->povoamento == null){
            return back();
          }
          $idPiscultura = $tanque->piscicultura_id;
          $piscicultura = \nemo\Piscicultura::find($idPiscultura); 
          date_default_timezone_set('America/Sao_Paulo');
          $data = date('Y-m-d');
          $hora = date('H:i');                 
          return view("cadastrarBiometria",['data_atual'=>$data,'hora_atual'=>$hora,'tanque_id'=>$tanque_id,'tanque' => $tanque,'piscicultura' => $piscicultura]);
      }
    
      public static function adicionar(Request $request){
            $tanque = \nemo\Tanque::find($request->id_tanque);
            //dd($tanque);
            $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
            $biometria = new \nemo\Biometria();
            $biometria->peso_total = $request->peso;
            $biometria->peso_medio = $request->peso/$request->quantidade;
            $biometria->data = $request->data;
            $biometria->hora = $request->hora;
            $biometria->ciclo_id = $ciclo->id;
            $biometria->quantidade = $request->quantidade;
            $biometria->save();
            
             return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);

          }
}
