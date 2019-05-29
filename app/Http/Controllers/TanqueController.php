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
    $idealPhM = array_fill(0,count($datasPh),8.5);
    $idealPhm = array_fill(0,count($datasPh),6.5);    
    $temperaturas = $ciclo->qualidade_agua->temperaturas;
    $datasTemp = $this->gerarDatas($temperaturas);
    $tempsData = $this->gerarQualidades($datasTemp,$temperaturas);
    $idealTempM = array_fill(0,count($datasTemp),30);
    $idealTempm = array_fill(0,count($datasTemp),26);
    $amonias = $ciclo->qualidade_agua->amonias;
    $datasAmonia = $this->gerarDatas($amonias);
    $amoniasData = $this->gerarQualidades($datasAmonia,$amonias);
    $idealAmoniaM = array_fill(0,count($datasAmonia),0.5);
    $idealAmoniam = array_fill(0,count($datasAmonia),0);
    $nitritos = $ciclo->qualidade_agua->nitritos;
    $datasNitrito = $this->gerarDatas($nitritos);
    $nitritosData = $this->gerarQualidades($datasNitrito,$nitritos);
    $idealNitritoM = array_fill(0,count($datasNitrito),0.5);
    $idealNitritom = array_fill(0,count($datasNitrito),0);
    $nitratos = $ciclo->qualidade_agua->nitratos;
    $datasNitrato = $this->gerarDatas($nitratos);
    $nitratosData = $this->gerarQualidades($datasNitrato,$nitratos);
    $idealNitratoM = array_fill(0,count($datasNitrato),0.5);
    $idealNitratom = array_fill(0,count($datasNitrato),0);
    $durezas = $ciclo->qualidade_agua->durezas;
    $datasDureza = $this->gerarDatas($durezas);
    $durezasData = $this->gerarQualidades($datasDureza,$durezas);
    $idealDurezam = array_fill(0,count($datasDureza),30);
    $alcalinidades = $ciclo->qualidade_agua->alcalinidades;
    $datasAlcalinidade = $this->gerarDatas($alcalinidades);
    $alcalinidadesData = $this->gerarQualidades($datasAlcalinidade,$alcalinidades);
    $idealAlcalinidadem = array_fill(0,count($datasAlcalinidade),30);    
    $oxigenios = $ciclo->qualidade_agua->oxigenios;
    $datasOxigenio = $this->gerarDatas($oxigenios);
    $oxigeniosData = $this->gerarQualidades($datasOxigenio,$oxigenios);
    $idealOxigeniom = array_fill(0,count($datasOxigenio),3);    
    $biometrias = $ciclo->biometrias;
    $datasBiometria = $this->gerarDatas($biometrias);
    $biometriasData = $this->gerarPesos($datasBiometria,$biometrias);
    $povoamento =$ciclo->povoamento;
    

		$line_chartPh = Charts::multi('line', 'highcharts')
			    ->title('PH')
			    ->elementLabel('Ph')
          ->labels($datasPh)
          ->colors(['#98FB98','#00CED1','#B22222'])
          ->dataset('Máximo ideal', $idealPhM)          
          ->dataset('Ph',$phsData)       
          ->dataset('Minimo ideal', $idealPhm)
			    ->dimensions(1000,500)
          ->responsive(true);
    
          
    $line_chartTemp = Charts::multi('line', 'highcharts')
			    ->title('Temperatura')
			    ->elementLabel('°C')
			    ->labels($datasTemp)
          ->colors(['#98FB98','#00CED1','#B22222'])
          ->dataset('Máximo ideal', $idealTempM)          
          ->dataset('temperatura',$tempsData)       
          ->dataset('Minimo ideal', $idealTempm)       
			    ->dimensions(1000,500)
          ->responsive(true); 

    $line_chartOxigenio = Charts::multi('line', 'highcharts')
          ->title('Oxigênio')
          ->elementLabel('mg/L')
          ->labels($datasOxigenio)
          ->colors(['#00CED1','#B22222'])
          ->dataset('Oxigênio',$oxigeniosData)       
          ->dataset('Minimo ideal', $idealOxigeniom)        
          ->dimensions(1000,500)
          ->responsive(true);

    $line_chartsAmoniaNitritoNitrato = Charts::multi('line','highcharts')
          ->title('Amônia, Nitrito e Nitrato')
          ->elementLabel('mg/L')
          ->labels($datasNitrito)
          ->colors(['#98FB98','#00CED1','#FFD700','#D8BFD8','#B22222'])
          ->dataset('Máximo ideal', $idealAmoniaM)        
          ->dataset('Amônia', $amoniasData)
          ->dataset('Nitrito', $nitritosData)
          ->dataset('Nitrato',$nitratosData)
          ->dataset('Minimo ideal', $idealAmoniam) 
          ->dimensions(1000,500)
          ->responsive(true);

    $line_chartsDurezaAlcalinidade= Charts::multi('line','highcharts')
          ->title('Dureza e Alcalinidade')
          ->elementLabel('mg CaCO3/L')
          ->labels($datasDureza)
          ->colors(['#00CED1','#FFD700','#B22222'])
          ->dataset('Dureza', $durezasData)
          ->dataset('Alcalinidade', $alcalinidadesData)
          ->dataset('Minimo ideal', $idealDurezam)
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
    

    return view('relatoriosTanque', compact('line_chartBiometria','line_chartsAmoniaNitritoNitrato','line_chartsDurezaAlcalinidade','line_chartOxigenio','line_chartPh', 'line_chartTemp'), ['tanque' => $tanque, 'piscicultura' => $piscicultura,'povoamento'=>$povoamento]);
  }

  public function gerarDatas($qualidades){
    //dd($qualidades);

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
          array_push($pesosDatas,1000*$biometria->peso_medio); 
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
      if($dataFinal <= 1){
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
    $dataPovoamento = $povoamento->data;
    $dataUltimaBiometria = $datasBiometria[count($datasBiometria)-1];
    //dd($dataPovoamento);
    $dataUltimaBiometria = str_replace("/", "-", $dataUltimaBiometria);
    $dias = (int)((strtotime($dataUltimaBiometria)-strtotime($dataPovoamento))/86400);
    $quinzena = (int)($dias/14);
    //dd($quinzena);
    $qv = $povoamento->quantidade;
    $j = 0;

    for ($j = 0; $j < $quinzena; $j++) { 
      if($j < 5) {
        $qv =  ($qv - (0.05 * $qv));     
      }else{
        $qv =  ($qv - (0.025 * $qv));
      }
    }
    $pv = $biometriasData[count($biometriasData)-1]*$qv;

    $pvMedio = $pv/$povoamento->quantidade;
    
    $tabela = [
      0.5 => ['temperatura' =>[
                  999 =>['porcentagem' => 17.5,
                        'nRefeicoes' => 8],
                  30 => ['porcentagem' => 17.5,
                        'nRefeicoes' => 8],
                  26 => ['porcentagem' => 12.5,
                        'nRefeicoes' => 6],
                  22 => ['porcentagem' => 8.5,
                        'nRefeicoes' => 5],
                  19=>['porcentagem' => 5,
                      'nRefeicoes' => 4]],
              'pb' => '40',
              'tamanho' => 'Pó fino <0,5mm'
            ],
      3 => ['temperatura' =>[
                  999 =>['porcentagem' => 11,
                        'nRefeicoes' => 6],
                  30 => ['porcentagem' => 11,
                        'nRefeicoes' => 6],
                  26 => ['porcentagem' => 8,
                        'nRefeicoes' => 5],
                  22 => ['porcentagem' => 5.5,
                        'nRefeicoes' => 4],
                  19=>['porcentagem' => 3.5,
                      'nRefeicoes' => 3]],
              'pb' => '40',
              'tamanho' => 'Pó fino <0,5mm'
            ],
      5 => ['temperatura' =>[
                  999 =>['porcentagem' => 9,
                        'nRefeicoes' => 5],
                  30 => ['porcentagem' => 9,
                        'nRefeicoes' => 5],
                  26 => ['porcentagem' => 6.5,
                        'nRefeicoes' => 4],
                  22 => ['porcentagem' => 4.5,
                        'nRefeicoes' => 3],
                  19=>['porcentagem' => 2.5,
                      'nRefeicoes' => 2]],
              'pb' => '40-36',
              'tamanho' => 'Pó fino de 2mm'
            ],
      10 => ['temperatura' =>[
                  999 =>['porcentagem' => 7,
                        'nRefeicoes' => 4],
                  30 => ['porcentagem' => 7,
                        'nRefeicoes' => 4],
                  26 => ['porcentagem' => 5,
                        'nRefeicoes' => 4],
                  22 => ['porcentagem' => 3.5,
                        'nRefeicoes' => 2],
                  19=>['porcentagem' => 2,
                      'nRefeicoes' => 1]],
              'pb' => '36',
              'tamanho' => '2mm'
            ],
      30 => ['temperatura' =>[
                  999 =>['porcentagem' => 5.5,
                        'nRefeicoes' => 3],
                  30 => ['porcentagem' => 5.5,
                        'nRefeicoes' => 3],
                  26 => ['porcentagem' => 3.5,
                        'nRefeicoes' => 2],
                  22 => ['porcentagem' => 2.5,
                        'nRefeicoes' => 2],
                  19=>['porcentagem' => 1,
                      'nRefeicoes' => 1]],
              'pb' => '36',
              'tamanho' => '2mm/4mm'
            ],
      200 => ['temperatura' =>[
                  999 =>['porcentagem' => 4.5,
                        'nRefeicoes' => 3],
                  30 => ['porcentagem' => 4.5,
                        'nRefeicoes' => 3],
                  26 => ['porcentagem' => 3.5,
                        'nRefeicoes' => 2],
                  22 => ['porcentagem' => 2,
                        'nRefeicoes' => 1],
                  19=>['porcentagem' => 1,
                      'nRefeicoes' => 1]],
              'pb' => '32',
              'tamanho' => '4mm'
            ],
      500 => ['temperatura' =>[
                  999 =>['porcentagem' => 2.5,
                        'nRefeicoes' => 3],
                  30 => ['porcentagem' => 3.5,
                        'nRefeicoes' => 3],
                  26 => ['porcentagem' => 2.5,
                        'nRefeicoes' => 2],
                  22 => ['porcentagem' => 1,
                        'nRefeicoes' => 1],
                  19=>['porcentagem' => 1,
                      'nRefeicoes' => 0.5]],
              'pb' => '32-28',
              'tamanho' => '4mm/6mm'
            ],
      1000 => ['temperatura' =>[
                  999 =>['porcentagem' => 2,
                        'nRefeicoes' => 2],
                  30 => ['porcentagem' => 2.5,
                        'nRefeicoes' => 2],
                  26 => ['porcentagem' =>1.5,
                        'nRefeicoes' => 2],
                  22 => ['porcentagem' => 1.5,
                        'nRefeicoes' => 1],
                  19=>['porcentagem' => 1,
                      'nRefeicoes' => 0.5]],
              'pb' => '32-28',
              'tamanho' => '6mm/8mm'
            ],
      900000 => ['temperatura' =>[
                  999 =>['porcentagem' => 1,
                        'nRefeicoes' => 2],
                  30 => ['porcentagem' => 1.5,
                        'nRefeicoes' => 2],
                  26 => ['porcentagem' => 1.5,
                        'nRefeicoes' => 1],
                  22 => ['porcentagem' => 0.75,
                        'nRefeicoes' => 1],
                  19=>['porcentagem' => 0.5,
                      'nRefeicoes' => 0.5]],
              'pb' => '32-28',
              'tamanho' => '6mm/12mm'
            ],
      ];
      foreach($tabela as $peso=>$valor){
        if ($pvMedio < $peso) {
          $tamanho = $valor['tamanho'];
          //dd($tamanho);
          $pb = $valor['pb'];
          foreach($valor['temperatura'] as $testTemp=>$dados){
            if($temperatura < $testTemp){
              //dd($dados['porcentagem']/100);
              $quantidade_total = $pv*($dados['porcentagem']/100);
              $refeicoes_por_dia = $dados['nRefeicoes'];
            }
          }
          break;
      }
    }
    
    
    $pv = number_format($pv, 2, ".", "");
    return view('racao', ['pv'=>$pv,'pvMedio'=>$pvMedio,'temperatura'=>$temperatura,'tamanho'=>$tamanho,'tanque' => $tanque, 'piscicultura' => $piscicultura, 'pb' => $pb, 'quantidade_total'=>$quantidade_total,'refeicoes_por_dia'=>$refeicoes_por_dia]);
  }

}

