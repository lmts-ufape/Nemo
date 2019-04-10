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
        $tanque->qualidade_aguas()->create([]);
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

  public function gerarRelatorios($id) {
    $tanque = \nemo\Tanque::find($id);
    $piscicultura = $tanque->piscicultura;
    $phs = $tanque->qualidade_aguas->phs;
    $datasPh = $this->gerarDatas($phs);
    $phsData = $this->gerarQualidades($datasPh,$phs);
    $temperaturas = $tanque->qualidade_aguas->temperaturas;
    $datasTemp = $this->gerarDatas($temperaturas);
    $tempsData = $this->gerarQualidades($datasTemp,$temperaturas);
    $amonias = $tanque->qualidade_aguas->amonias;
    $datasAmonia = $this->gerarDatas($amonias);
    $amoniasData = $this->gerarQualidades($datasTemp,$amonias);
    $nitritos = $tanque->qualidade_aguas->nitritos;
    $datasNitrito = $this->gerarDatas($nitritos);
    $nitritosData = $this->gerarQualidades($datasTemp,$nitritos);
    $nitratos = $tanque->qualidade_aguas->nitratos;
    $datasNitrato = $this->gerarDatas($nitratos);
    $nitratosData = $this->gerarQualidades($datasTemp,$nitratos);
    $durezas = $tanque->qualidade_aguas->durezas;
    $datasDureza = $this->gerarDatas($durezas);
    $durezasData = $this->gerarQualidades($datasTemp,$durezas);
    $alcalinidades = $tanque->qualidade_aguas->alcalinidades;
    $datasAlcalinidade = $this->gerarDatas($alcalinidades);
    $alcalinidadesData = $this->gerarQualidades($datasTemp,$alcalinidades);
    $oxigenios = $tanque->qualidade_aguas->oxigenios;
    $datasOxigenio = $this->gerarDatas($oxigenios);
    $oxigeniosData = $this->gerarQualidades($datasTemp,$oxigenios);
    $biometrias = $tanque->biometrias;
    $datasBiometria = $this->gerarDatas($biometrias);
    $biometriasData = $this->gerarPesos($datasBiometria,$biometrias);
    

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
          
    

    return view('relatoriosTanque', compact('line_chartBiometria','line_chartNitrato','line_chartNitrito','line_chartDureza','line_chartAlcalinidade','line_chartOxigenio','line_chartPh', 'line_chartTemp', 'line_chartAmonia'), ['tanque' => $tanque, 'piscicultura' => $piscicultura]);
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

  public function tabelaRacao($id){
    $tanque = \nemo\Tanque::find($id);
    $piscicultura = $tanque->piscicultura;
    $temperaturas = $tanque->qualidade_aguas->temperaturas;
    $datasTemp = $this->gerarDatas($temperaturas);
    $tempsData = $this->gerarQualidades($datasTemp,$temperaturas);
    $biometrias = $tanque->biometrias;
    $datasBiometria = $this->gerarDatas($biometrias);
    $biometriasData = $this->gerarPesos($datasBiometria,$biometrias);
    $pb = 0;
    $quantidade_total = 0;
    $quantidade_por_refeicao = 0;
    $refeicoes_por_dia = 0;
    $tamanho = 0;
    if($biometriasData[count($biometriasData)-1] < 0.0005){
        $tamanho = "Pó fino < 0,5mm";
        $pb = '40';
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '15% a 20% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '6 a 8';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '15% a 20% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '6 a 8';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '10% a 15% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '5 a 6';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '7% a 10% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '4 a 5';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '4% a 6% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '3 a 4';
      }
    }elseif($biometriasData[count($biometriasData)-1] <= 0.0005 && $biometriasData[count($biometriasData)-1] > 0.003){
        $tamanho = "Pó fino < 0,5mm";
        $pb = '40';      
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '10% a 12% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '5 a 6';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '10% a 12% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '5 a 6';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '7% a 9% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '4 a 5';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '5% a 6% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '3 a 4';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '3% a 4% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }
    }elseif($biometriasData[count($biometriasData)-1] <= 0.003 && $biometriasData[count($biometriasData)-1] > 0.005){
      $tamanho = "Pó fino < 0,5mm";
      $pb = '40 ou 36';      
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '8% a 10% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '4 a 5';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '8% a 10% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '4 a 5';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '6% a 7% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '3 a 4';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '4% a 5% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '2% a 3% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2';
      }
    }elseif($biometriasData[count($biometriasData)-1] <= 0.005 && $biometriasData[count($biometriasData)-1] > 0.010){
      $tamanho = "2mm";
      $pb = '36'; 
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '6% a 8% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '3 a 4';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '6% a 8% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '3 a 4';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '4% a 6% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 4';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '3% a 4% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '2% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1';
      }
    }elseif($biometriasData[count($biometriasData)-1] <= 0.010 && $biometriasData[count($biometriasData)-1] > 0.030){
        $tamanho = '2mm a 4mm';
        $pb = '36';      
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '5% a 6% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '5% a 6% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '3% a 4% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '2% a 3% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1 a 2';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '1% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1';
      }
    }elseif($biometriasData[count($biometriasData)-1] <= 0.030 && $biometriasData[count($biometriasData)-1] > 0.200){
      $tamanho = '4mm';
      $pb = '32';     
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '4% a 5% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '4% a 5% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '3% a 4% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1 a 2';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '2% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '1% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1';
      }
    }elseif($biometriasData[count($biometriasData)-1] <= 0.200 && $biometriasData[count($biometriasData)-1] > 0.500){
      $tamanho = '4mm a 6mm';
      $pb = '28 a 32';       
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '2% a 3% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '3% a 4% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '2 a 3';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '2% a 3% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1 a 2';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '1% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '1% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1/2';
      }
    }elseif($biometriasData[count($biometriasData)-1] <= 0.500 && $biometriasData[count($biometriasData)-1] > 1){
      $tamanho = '6mm a 8mm';
      $pb = '28 a 32';
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '2% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1 a 2';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '2% a 3% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1 a 2';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '1% a 2% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1 a 2';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '1% a 2% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '1% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1/2';
      }
    }elseif($biometriasData[count($biometriasData)-1] > 1){
      $tamanho = '6mm a 12mm';
      $pb = '28 a 32';
      if(($tempsData[count($tempsData)-1])>30){
        $quantidade_total = '1% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1 a 2';
      }elseif($tempsData[count($tempsData)-1] >= 27 && $tempsData[count($tempsData)-1] <= 30){
        $quantidade_total = '1% a 2% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1 a 2';
      }elseif($tempsData[count($tempsData)-1] >= 23 && $tempsData[count($tempsData)-1] <= 26){
        $quantidade_total = '1% a 2% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1';
      }elseif($tempsData[count($tempsData)-1] >= 19 && $tempsData[count($tempsData)-1] <= 22){
        $quantidade_total = '0,5% a 1% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1';
      }elseif($tempsData[count($tempsData)-1] < 19){
        $quantidade_total = '0,5% do PV';
        $quantidade_por_refeicao = 0;
        $refeicoes_por_dia = '1/2';
      }
    }
    return view('racao', ['tamanho'=>$tamanho,'tanque' => $tanque, 'piscicultura' => $piscicultura, 'pb' => $pb, 'quantidade_total'=>$quantidade_total,'refeicoes_por_dia'=>$refeicoes_por_dia,'quantidade_por_refeicao'=>$quantidade_por_refeicao ]);
  }

}

