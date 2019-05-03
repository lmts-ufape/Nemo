<?php

use nemo\Tanque;

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use nemo\Validator\TanqueValidator;
use Charts;
use nemo\QualidadeAgua;
use phpDocumentor\Reflection\Types\Object_;

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

    try{

      TanqueValidator::validate($request->all());

      $piscicultura = \nemo\Piscicultura::find($request->id_piscicultura);
      $tanque = $piscicultura->tanques()->create([
        'nome' => $request->nome,
        'volume' => $request->volume,
        'area' => $request->area,
        'altura' => $request->altura,
        //'formato' => $request->formato,
        'manutencao_necessaria' => 'Não'
        ]);
        $ciclos = $tanque->ciclos()->create([]);
        $ciclos->qualidade_agua()->create([]);
        //dd($ciclos->povoamento);
        return redirect()->route("tanque.listar", ['piscicultura' => $request->id_piscicultura]);
    }catch(\nemo\Validator\ValidationException $e){

			return back()->withErrors($e->getValidator())->withInput();
			
		}
      
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
     
    try{
      TanqueValidator::validate($request->all());
      $tanque->volume = $request->volume;
      $tanque->nome = $request->nome;
      $tanque->altura = $request->altura;
      $tanque->area = $request->area;
      //$tanque->formato = $request->formato;
      $tanque->update();
      return redirect()->route("tanque.detalhar", ['id' => $request->id]);

    }catch(\nemo\Validator\ValidationException $e){

			return back()->withErrors($e->getValidator())->withInput();
			
		}
    
  }

  public function remover(Request $request){
    $tanque = \nemo\Tanque::find($request->id);
    $piscicultura = \nemo\Piscicultura::find($tanque->piscicultura_id);
    $tanque->delete();
  	return redirect()->route("tanque.listar", ['id' => $tanque->piscicultura_id]);
	}

  
  public function exibirDetalhes($id) {
    $tanque = \nemo\Tanque::find($id);
    $piscicultura = $tanque->piscicultura;
    return view("detalhesTanque", [
      'tanque' => $tanque,
      'piscicultura' => $piscicultura,
    ]);
  }

  public function manutencao($id) {
    $tanque = \nemo\Tanque::find($id);
    $piscicultura = $tanque->piscicultura;
    $tanque->status = "livre";
    $tanque->update();
    $ciclos = $tanque->ciclos()->create([]);
    $ciclos->qualidade_agua()->create([]);
    return redirect()->route("tanque.listar", ['piscicultura' => $piscicultura->id]);
  }

  public function gerarRelatorios($id) {
    $tanque = \nemo\Tanque::find($id);
    $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
    $piscicultura = $tanque->piscicultura;
    $phs = $ciclo->qualidade_agua->phs;
    $datasPh = $this->gerarDatas($phs);
    $phsData = $this->gerarQualidades($datasPh,$phs);
    $temperaturas = $ciclo->qualidade_agua->temperaturas;
    $temperaturas = $ciclo->qualidade_agua->temperaturas;
    $datasTemp = $this->gerarDatas($temperaturas);
    $tempsData = $this->gerarQualidades($datasTemp,$temperaturas);
    $amonias = $ciclo->qualidade_agua->amonias;
    $amonias = $ciclo->qualidade_agua->amonias;
    $datasAmonia = $this->gerarDatas($amonias);
    $amoniasData = $this->gerarQualidades($datasTemp,$amonias);
    $nitritos = $ciclo->qualidade_agua->nitritos;
    $nitritos = $ciclo->qualidade_agua->nitritos;
    $datasNitrito = $this->gerarDatas($nitritos);
    $nitritosData = $this->gerarQualidades($datasTemp,$nitritos);
    $nitratos = $ciclo->qualidade_agua->nitratos;
    $nitratos = $ciclo->qualidade_agua->nitratos;
    $datasNitrato = $this->gerarDatas($nitratos);
    $nitratosData = $this->gerarQualidades($datasTemp,$nitratos);
    $durezas = $ciclo->qualidade_agua->durezas;
    $durezas = $ciclo->qualidade_agua->durezas;
    $datasDureza = $this->gerarDatas($durezas);
    $durezasData = $this->gerarQualidades($datasTemp,$durezas);
    $alcalinidades = $ciclo->qualidade_agua->alcalinidades;
    $alcalinidades = $ciclo->qualidade_agua->alcalinidades;
    $datasAlcalinidade = $this->gerarDatas($alcalinidades);
    $alcalinidadesData = $this->gerarQualidades($datasTemp,$alcalinidades);
    $oxigenios = $ciclo->qualidade_agua->oxigenios;
    $oxigenios = $ciclo->qualidade_agua->oxigenios;
    $datasOxigenio = $this->gerarDatas($oxigenios);
    $oxigeniosData = $this->gerarQualidades($datasTemp,$oxigenios);
    $biometrias = $ciclo->biometrias;
    $biometrias = $ciclo->biometrias;
    $datasBiometria = $this->gerarDatas($biometrias);
    $biometriasData = $this->gerarPesos($datasBiometria,$biometrias);
    // $pescas = $ciclo->pescas;
    // $pescas = $ciclo->pescas;
    // $datasPesca = $this->gerarDatas($pescas);
    // $pescasData = $this->getPesos($datasPesca,$pescas);
    

		$line_chartPh = Charts::create('line', 'highcharts')
			    ->title('PH')
			    ->elementLabel('Ph')
			    ->labels($datasPh)
          ->values($phsData)       
			    ->dimensions(1000,500)
          ->responsive(true);
    
          
    $line_chartTemp = Charts::create('line', 'highcharts')
			    ->title('Temperatura')
			    ->elementLabel('°C')
			    ->labels($datasTemp)
          ->values($tempsData)       
			    ->dimensions(1000,500)
          ->responsive(true); 

    $line_chartAmonia = Charts::create('line', 'highcharts')
			    ->title('Amônia')
			    ->elementLabel('mg/L')
			    ->labels($datasAmonia)
          ->values($amoniasData)       
			    ->dimensions(1000,500)
          ->responsive(true);

    $line_chartNitrato = Charts::create('line', 'highcharts')
			    ->title('Nitrato')
			    ->elementLabel('mg/L')
			    ->labels($datasNitrato)
          ->values($nitratosData)       
			    ->dimensions(1000,500)
          ->responsive(true);

    $line_chartNitrito = Charts::create('line', 'highcharts')
			    ->title('Nitrito')
			    ->elementLabel('mg/L')
			    ->labels($datasNitrito)
          ->values($nitritosData)       
			    ->dimensions(1000,500)
          ->responsive(true);
    
    $line_chartAlcalinidade = Charts::create('line', 'highcharts')
			    ->title('Alcalinidade')
			    ->elementLabel('mg CaCO3/L')
			    ->labels($datasAlcalinidade)
          ->values($alcalinidadesData)       
			    ->dimensions(1000,500)
          ->responsive(true);

    $line_chartDureza = Charts::create('line', 'highcharts')
			    ->title('Dureza')
			    ->elementLabel('mg CaCO3/L')
			    ->labels($datasDureza)
          ->values($durezasData)       
			    ->dimensions(1000,500)
          ->responsive(true);

    $line_chartOxigenio = Charts::create('line', 'highcharts')
			    ->title('Oxigênio')
			    ->elementLabel('mg/L')
			    ->labels($datasOxigenio)
          ->values($oxigeniosData)       
			    ->dimensions(1000,500)
          ->responsive(true);

    $line_chartBiometria = Charts::create('line', 'highcharts')
			    ->title('Biometria')
			    ->elementLabel('Kg')
			    ->labels($datasBiometria)
          ->values($biometriasData)       
			    ->dimensions(1000,500)
          ->responsive(true);
          
    // $line_chartPesca = Charts::create('line', 'highcharts')
		// 	    ->title('Pescas')
		// 	    ->elementLabel('Kg')
		// 	    ->labels($datasPesca)
    //       ->values($pescasData)       
		// 	    ->dimensions(1000,500)
    //       ->responsive(true);
    

    return view('relatoriosTanque', compact('line_chartBiometria','line_chartNitrato','line_chartNitrito','line_chartDureza','line_chartAlcalinidade','line_chartOxigenio','line_chartPh', 'line_chartTemp', 'line_chartAmonia'), ['tanque' => $tanque, 'piscicultura' => $piscicultura]);
    //return view('relatoriosTanque', compact('line_chartPesca','line_chartBiometria','line_chartNitrato','line_chartNitrito','line_chartDureza','line_chartAlcalinidade','line_chartOxigenio','line_chartPh', 'line_chartTemp', 'line_chartAmonia'), ['tanque' => $tanque, 'piscicultura' => $piscicultura]);
  }

  public function gerarDatas($qualidades){
    $datas = array();
    
    foreach ($qualidades as &$qualidade) {
      $dataHora = $qualidade->data . " " . $qualidade->hora;
      $str = str_replace("-", "/", $dataHora);
      array_push($datas,$str);   
      
    }
    sort($datas);
    return $datas;    
  }

  public function gerarQualidades($datas,$qualidades){
    $qualidadesData = array();
    foreach($datas as &$data){
      foreach($qualidades as &$qualidade){
        $dataHora = $qualidade->data . " " . $qualidade->hora;
        $str = str_replace("-", "/", $dataHora);
        if($data == $str){
          array_push($qualidadesData,$qualidade->valor); 
        }
      }
    }
    return $qualidadesData;
  }
  public function gerarPesos($datas,$biometrias){
    $pesosDatas = array();
    foreach($datas as &$data){
      foreach($biometrias as &$biometria){
        $dataHora = $biometria->data . " " . $biometria->hora;
        $str = str_replace("-", "/", $dataHora);
        if($data == $str){
          array_push($pesosDatas,$biometria->peso_medio); 
        }
      }
    }
    return $pesosDatas;
  }

  public function getPesos($datas,$pescas){
    $pesosDatas = array();
    foreach($datas as &$data){
      foreach($pescas as &$pesca){
        $dataHora = $pesca->data . " " . $pesca->hora;
        $str = str_replace("-", "/", $dataHora);
        if($data == $str){
          array_push($pesosDatas,$pesca->peso); 
        }
      }
    }
    return $pesosDatas;
  }

  public function temperaturaMedia($datasTemp,$tempsData){
    $temps = array();
    $i = 0;
    foreach($datasTemp as $temp){
      $dataFinal = (strtotime($datasTemp[count($datasTemp)-1]) - strtotime($temp)) /86400;
      if($dataFinal <= 7){
        array_push($temps,$tempsData[$i]);
      }
      $i++;
    }
    $temp = array_sum($temps) / count(array_filter($temps));
    return $temp;
  } 

  public function tabelaRacao($id){
    $tanque = \nemo\Tanque::find($id);
    $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
    if($ciclo->povoamento == null && count($ciclo->qualidade_agua->temperaturas)==0 && count($ciclo->biometrias)==0){
      return back();
    }
    $piscicultura = $tanque->piscicultura;
    $ciclo = $tanque->ciclos[count($tanque->ciclos)-1];
    $temperaturas = $ciclo->qualidade_agua->temperaturas;
    $datasTemp = $this->gerarDatas($temperaturas);
    $tempsData = $this->gerarQualidades($datasTemp,$temperaturas);
    $temperatura = $this->temperaturaMedia($datasTemp,$tempsData);
    $biometrias = $ciclo->biometrias;
    $datasBiometria = $this->gerarDatas($biometrias);
    $biometriasData = $this->gerarPesos($datasBiometria,$biometrias);
    $povoamento = $ciclo->povoamento;
    //dd($povoamento);
    $pb = 0;
    $quantidade_total = 0;
    $refeicoes_por_dia = 0;
    $tamanho = 0;
    $pv = $biometriasData[count($biometriasData)-1]*$povoamento->quantidade;
    $i = 0;
    for ($i = 0; $i < count($biometriasData); $i++) {
      if($i < 4) {
        $pv =  1000*($pv - (0.05 * $pv));      
      }else{
        $pv =  1000*($pv - (0.025 * $pv));
      }
    }

    if($biometriasData[count($biometriasData)-1] < 0.0005){
        $tamanho = "Pó fino < 0,5mm";
        $pb = '40g';
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = 0.175*$pv;
        $refeicoes_por_dia = '6 a 8';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.175*$pv;;
        $refeicoes_por_dia = '6 a 8';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.125*$pv;;
        $refeicoes_por_dia = '5 a 6';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.085*$pv;;
        $refeicoes_por_dia = '4 a 5';
      }elseif($temperatura < 19){
        $quantidade_total = 0.05*$pv;;
        $refeicoes_por_dia = '3 a 4';
      }
    }elseif($biometriasData[count($biometriasData)-1] >= 0.0005 && $biometriasData[count($biometriasData)-1] < 0.003){
        $tamanho = "Pó fino < 0,5mm";
        $pb = '40g'; 
      if(($temperatura)>30){
        $quantidade_total = 0.11*$pv;;
        $refeicoes_por_dia = '5 a 6';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.11*$pv;;
        $refeicoes_por_dia = '5 a 6';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.08*$pv;;
        $refeicoes_por_dia = '4 a 5';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.055*$pv;;
        $refeicoes_por_dia = '3 a 4';
      }elseif($temperatura < 19){
        $quantidade_total = 0.035*$pv;;
        $refeicoes_por_dia = '2 a 3';
      }
    }elseif($biometriasData[count($biometriasData)-1] >= 0.003 && $biometriasData[count($biometriasData)-1] < 0.005){
      $tamanho = "Pó fino < 0,5mm";
      $pb = '40g ou 36g';      
      if(($temperatura)>30){
        $quantidade_total = 0.09*$pv;;
        $refeicoes_por_dia = '4 a 5';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.09*$pv;
        $refeicoes_por_dia = '4 a 5';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.065*$pv;
        $refeicoes_por_dia = '3 a 4';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.045*$pv;
        $refeicoes_por_dia = '2 a 3';
      }elseif($temperatura < 19){
        $quantidade_total = 0.025*$pv;
        $refeicoes_por_dia = '2';
      }
    }elseif($biometriasData[count($biometriasData)-1] >= 0.005 && $biometriasData[count($biometriasData)-1] < 0.010){
      $tamanho = "2mm";
      $pb = '36'; 
      if(($temperatura)>30){
        $quantidade_total = 0.070*$pv;
        $refeicoes_por_dia = '3 a 4';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.070*$pv;
        $refeicoes_por_dia = '3 a 4';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.050*$pv;
        $refeicoes_por_dia = '2 a 4';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.035*$pv;
        $refeicoes_por_dia = '2';
      }elseif($temperatura < 19){
        $quantidade_total = 0.020*$pv;
        $refeicoes_por_dia = '1';
      }
    }elseif($biometriasData[count($biometriasData)-1] >= 0.010 && $biometriasData[count($biometriasData)-1] < 0.030){
        $tamanho = '2mm a 4mm';
        $pb = '36g';      
      if(($temperatura)>30){
        $quantidade_total = 0.055*$pv;
        $refeicoes_por_dia = '2 a 3';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.055*$pv;
        $refeicoes_por_dia = '2 a 3';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.035*$pv;
        $refeicoes_por_dia = '2 a 3';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.025*$pv;
        $refeicoes_por_dia = '1 a 2';
      }elseif($temperatura < 19){
        $quantidade_total = 0.010*$pv;
        $refeicoes_por_dia = '1';
      }
    }elseif($biometriasData[count($biometriasData)-1] >= 0.030 && $biometriasData[count($biometriasData)-1] < 0.200){
      $tamanho = '4mm';
      $pb = '32g';     
      if(($temperatura)>30){
        $quantidade_total = 0.045*$pv;;
        $refeicoes_por_dia = '2 a 3';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.045*$pv;
        $refeicoes_por_dia = '2 a 3';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.035*$pv;
        $refeicoes_por_dia = '1 a 2';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.02*$pv;
        $refeicoes_por_dia = '1';
      }elseif($temperatura < 19){
        $quantidade_total = 0.01*$pv;
        $refeicoes_por_dia = '1';
      }
    }elseif($biometriasData[count($biometriasData)-1] >= 0.200 && $biometriasData[count($biometriasData)-1] < 0.500){
      $tamanho = '4mm a 6mm';
      $pb = '28 a 32';       
      if(($temperatura)>30){
        $quantidade_total = 0.025*$pv;
        $refeicoes_por_dia = '2 a 3';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.035*$pv;
        $refeicoes_por_dia = '2 a 3';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.025*$pv;
        $refeicoes_por_dia = '1 a 2';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.01*$pv;
        $refeicoes_por_dia = '1';
      }elseif($temperatura < 19){
        $quantidade_total = 0.01*$pv;
        $refeicoes_por_dia = '1/2';
      }
    }elseif($biometriasData[count($biometriasData)-1] >= 0.500 && $biometriasData[count($biometriasData)-1] <= 1){
      $tamanho = '6mm a 8mm';
      $pb = '28 a 32';
      if(($temperatura)>30){
        $quantidade_total = 0.020*$pv;
        $refeicoes_por_dia = '1 a 2';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.025*$pv;
        $refeicoes_por_dia = '1 a 2';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.015*$pv;
        $refeicoes_por_dia = '1 a 2';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.015*$pv;
        $refeicoes_por_dia = '1';
      }elseif($temperatura < 19){
        $quantidade_total = 0.010*$pv;
        $refeicoes_por_dia = '1/2';
      }
    }elseif($biometriasData[count($biometriasData)-1] > 1){
      $tamanho = '6mm a 12mm';
      $pb = '28 a 32';
      if(($temperatura)>30){
        $quantidade_total = 0.010*$pv;
        $refeicoes_por_dia = '1 a 2';
      }elseif($temperatura >= 27 && $temperatura <= 30){
        $quantidade_total = 0.015*$pv;
        $refeicoes_por_dia = '1 a 2';
      }elseif($temperatura >= 23 && $temperatura <= 26){
        $quantidade_total = 0.015*$pv;
        $refeicoes_por_dia = '1';
      }elseif($temperatura >= 19 && $temperatura <= 22){
        $quantidade_total = 0.0075*$pv;
        $refeicoes_por_dia = '1';
      }elseif($temperatura < 19){
        $quantidade_total = 0.005*$pv;
        $refeicoes_por_dia = '1/2';
      }
    }
    return view('racao', ['tamanho'=>$tamanho,'tanque' => $tanque, 'piscicultura' => $piscicultura, 'pb' => $pb, 'quantidade_total'=>$quantidade_total,'refeicoes_por_dia'=>$refeicoes_por_dia]);
  }

}

