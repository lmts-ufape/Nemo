<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use nemo\Validator\EscalonamentoValidator;

class EscalonamentoController extends Controller{

    public function __construct(){
		  $this->middleware('auth');
    }
    
    public function chamaEscalonamento($id){
      $piscicultura = \nemo\Piscicultura::find($id);
      $especiePeixe = \nemo\EspeciePeixe::where('piscicultura_id','=',$id)->get();
      //$quantidade_tanques = count($tanques);
      
      return view('escalonamentoProducao', [
        'piscicultura' => $piscicultura,
        'especiePeixe' => $especiePeixe,
        //'quantidade_tanques' => $quantidade_tanques,
      ]);

    }

    public function calcularEscalonamento(Request $request){
      try{

        EscalonamentoValidator::validate($request->all());

        $volumeTanque = $request->volume;
        $quantidadePeixes = $request->quantidade_peixes;
        $periodicidade = $request->periodicidade;
        try{
          $especiePeixe = \nemo\EspeciePeixe::find($request->especie);
        }catch(\Illuminate\Database\QueryException $e){
          return back()->withInput();
        }

        $numeroPeixesPorTanque = $volumeTanque * $especiePeixe->quantidade_por_volume;
        $ciclo = $especiePeixe->tempo_desenvolvimento + 1;
        $tanquesNecessarios = 0;
        if($periodicidade == 7){
          $tanquesNecessarios = $ciclo * 4;
        }elseif($periodicidade == 15){
          $tanquesNecessarios = $ciclo * 2;
        }elseif($periodicidade == 30){
          $tanquesNecessarios = $ciclo;
        }else{
          return back()->withInput();
        }

        $aux = $numeroPeixesPorTanque / $quantidadePeixes;
        $tanquesNecessarios = ceil($tanquesNecessarios / $aux);

        $piscicultura = \nemo\Piscicultura::find($request->piscicultura_id);

        return view('resultadoEscalonamento', [
          'piscicultura' => $piscicultura,
          'producaoPorCiclo' => $quantidadePeixes,
          'periodicidade' => $periodicidade,
          'tanquesNecessarios' => $tanquesNecessarios,
          'duracaoCiclo' => $ciclo,
          'volumeTanque' => $volumeTanque
        ]);
      }catch(\nemo\Validator\ValidationException $e){
        return back()->withErrors($e->getValidator())->withInput();
      }
      
      

    }

}