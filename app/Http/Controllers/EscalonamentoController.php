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
      //$especiePeixe = \nemo\EspeciePeixe::where('piscicultura_id','=',$id)->get();
      //$quantidade_tanques = count($tanques);

      return view('escalonamentoProducao', [
        'piscicultura' => $piscicultura,
        //'especiePeixe' => $especiePeixe,
        //'quantidade_tanques' => $quantidade_tanques,
      ]);

    }

    public function calcularEscalonamento(Request $request){
      try{

        EscalonamentoValidator::validate($request->all());

        $pesoMedio = $request->pesoMedio;
        $duracaoCiclo = $request->duracaoCiclo;
        $periodicidade = $request->periodicidade;
        $producaoDesejada = $request->producaoDesejada;
        $inicioProducao = $request->inicioProducao;

        $tilapia = \nemo\EspeciePeixe::find(1);
        $tanques = \nemo\Tanque::where("piscicultura_id","=",$request->piscicultura_id)->orderBy('volume', 'asc')->get();
        $piscicultura = \nemo\Piscicultura::find($request->piscicultura_id);
        // $menorVolume = \nemo\Tanques::where()->orderBy('volume', 'asc')->take(1)->get();
        // $numeroPeixesPorTanque = $menorVolume * $tilapia->quantidade_por_volume;
        $quantIndvAdultos = ($producaoDesejada*1000) / $pesoMedio;
        $mortalidade = 0;
        $volumeMinimo = $quantIndvAdultos / $tilapia->quantidade_por_volume;

        if($periodicidade == 7){
          $ciclosNecessarios = $duracaoCiclo * 4;
        }elseif($periodicidade == 14){
          $ciclosNecessarios = $duracaoCiclo * 2;
        }elseif($periodicidade == 28){
          $ciclosNecessarios = $duracaoCiclo;
        }else{
          return back()->withInput();
        }

        $nBiometrias = $duracaoCiclo * 2;
        $fatorMultipliador = ((100/98.5)**4)*((100/99.7)**($nBiometrias-4));
        $quantPovoamento = ceil($fatorMultipliador*$quantIndvAdultos);

        // if(!escalonamentoEhPossivel){
        //   return back()->withInput();
        // }

        $data = [];
        $acoes = [];
        $quant = [];
        $tanquesEscalonamento = [];
        $povoamento = "Povoar";
        $povRestante = 0;
        $dataAtual = $inicioProducao;
        $ciclosIniciados = 0;

        foreach($tanques as $tanque){
          if($ciclosIniciados < $ciclosNecessarios){
            $metrosCubicos = $tanque->volume/1000;
            $indvAdultos = $metrosCubicos*$tilapia->quantidade_por_volume;
            $povPossivel = ceil($fatorMultipliador*$indvAdultos);
            // dd($povAlevino);
            if($povRestante == 0){
              if($povPossivel >= $quantIndvAdultos){
                array_push($data, date('m/d/Y', strtotime($dataAtual)));
                array_push($acoes, $povoamento);
                array_push($quant, $quantPovoamento);
                array_push($tanquesEscalonamento, $tanque->nome);
                if($periodicidade == 7){
                  $dataAtual = date('m/d/Y', strtotime('+7 days',strtotime($dataAtual)));
                }elseif($periodicidade == 14){
                  $dataAtual = date('m/d/Y', strtotime('+14 days',strtotime($dataAtual)));
                }elseif($periodicidade == 28){
                  $dataAtual = date('m/d/Y', strtotime('+28 days',strtotime($dataAtual)));
                }
                $ciclosIniciados++;
              }else{
                // $auxIndAdultos = $tanque->volume * $tilapia->quantidade_por_volume;
                // $povPossivel = ceil($fatorMultipliador*$auxIndAdultos);
                $povRestante = $quantPovoamento - $povPossivel;
                array_push($data, date('m/d/Y', strtotime($dataAtual)));
                array_push($acoes, $povoamento);
                array_push($quant, $povPossivel);
                array_push($tanquesEscalonamento, $tanque->nome);
              }
            }else{
              // $auxIndAdultos = $tanque->volume * $tilapia->quantidade_por_volume;
              // $povPossivel = ceil($fatorMultipliador*$auxIndAdultos);
              if($povRestante <= $povPossivel){
                array_push($data, date('m/d/Y', strtotime($dataAtual)));
                array_push($acoes, $povoamento);
                array_push($quant, $povRestante);
                array_push($tanquesEscalonamento, $tanque->nome);
                $povRestante = 0;
                if($periodicidade == 7){
                  $dataAtual = date('m/d/Y', strtotime('+7 days',strtotime($dataAtual)));
                }elseif($periodicidade == 14){
                  $dataAtual = date('m/d/Y', strtotime('+14 days',strtotime($dataAtual)));
                }elseif($periodicidade == 28){
                  $dataAtual = date('m/d/Y', strtotime('+28 days',strtotime($dataAtual)));
                }
                $ciclosIniciados++;
              }else{
                $povRestante = $povRestante - $povPossivel;
                array_push($data, date('m/d/Y', strtotime($dataAtual)));
                array_push($acoes, $povoamento);
                array_push($quant, $povPossivel);
                array_push($tanquesEscalonamento, $tanque->nome);
              }
            }
          }
        }

        $datasPesca = [];
        $diasParaPesca = $duracaoCiclo * 28;
        for($i = 0; $i < count($data); $i++){
          $novaData = "+".$diasParaPesca." days";
          array_push($datasPesca, date('m/d/Y', strtotime($novaData, strtotime($data[$i]))));
        }

        if($ciclosIniciados == $ciclosNecessarios){
          return view('resultadoEscalonamento', [
            'piscicultura' => $piscicultura,
            'datas' => $data,
            'acoes' => $acoes,
            'quantidadePov' => $quant,
            'tanquesEscalonamento' => $tanquesEscalonamento,
            'datasPesca' => $datasPesca,
          ]);
        }else{
          return back()->withInput()->with("Fail","Impossivel fazer o escalonamento com os parâmetros e recursos atuais.");
        }
      }catch(\nemo\Validator\ValidationException $e){
        return back()->withErrors($e->getValidator())->withInput();
      }

    }

    public function chamaProjecao($id){
      $piscicultura = \nemo\Piscicultura::find($id);
      return view('calcularProjecao', [
        'piscicultura' => $piscicultura,
      ]);
    }

    public function calcularProjecao(Request $request){
      $pesoMedio = $request->pesoMedio;
      $duracaoCiclo = $request->duracaoCiclo;
      $periodicidade = $request->periodicidade;
      $producaoDesejada = $request->producaoDesejada;
      $inicioProducao = $request->inicioProducao;

      $tilapia = \nemo\EspeciePeixe::find(1);
      $piscicultura = \nemo\Piscicultura::find($request->piscicultura_id);

      $quantIndvAdultos = ($producaoDesejada*1000) / $pesoMedio;
      $volumeMinimo = $quantIndvAdultos / $tilapia->quantidade_por_volume;
      $volumeMinimo = ceil($volumeMinimo*1000);

      if($periodicidade == 7){
        $tanquesNecessarios = $duracaoCiclo * 4;
      }elseif($periodicidade == 14){
        $tanquesNecessarios = $duracaoCiclo * 2;
      }elseif($periodicidade == 28){
        $tanquesNecessarios = $duracaoCiclo;
      }else{
        return back()->withInput();
      }

      return view('resultadoProjecao', [
        'piscicultura' => $piscicultura,
        'tanquesNecessarios' => $tanquesNecessarios,
        'volumeMinimo' => $volumeMinimo,
      ]);
    }

}
