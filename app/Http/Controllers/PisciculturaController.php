<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use nemo\Validator\PisciculturaValidator;
use nemo\Piscicultura;
use Charts;

class PisciculturaController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

    public function listar(){
			$gerenciars = \nemo\Gerenciar::where('user_id','=',\Auth::user()->id)->get();

			$pisciculturas = array();

			foreach ($gerenciars as &$gerenciar) {
				$piscicultura = \nemo\Piscicultura::find($gerenciar->piscicultura_id);
				array_push($pisciculturas,$piscicultura);
			}

			return view('listarPisciculturas', ['pisciculturas' => $pisciculturas]);
	}
	
	public function informar($piscicultura_id){
		$piscicultura = \nemo\Piscicultura::find($piscicultura_id);
		$tanques = \nemo\Tanque::where('piscicultura_id','=',$piscicultura_id)->get();
		$gerenciadores = \nemo\Gerenciar::where('piscicultura_id','=',$piscicultura_id)->where('is_administrador','=',0)->get();
		$administrador = \nemo\Gerenciar::where('piscicultura_id','=',$piscicultura_id)->where('is_administrador','=',1)->first();		

		$dono = False;
		if($administrador->user_id == \Auth::user()->id){
			$dono = True;
		}

		return view('informarPiscicultura', [
			'piscicultura' => $piscicultura,
			'quantidade_tanques' => count($tanques),
			'quantidade_gerenciadores' => count($gerenciadores),
			'dono' => $dono,
			'user_id' => \Auth::user()->id,
		]);
	}

    public function cadastrar(){
    	return view("cadastrarPiscicultura");
    }

    public function adicionar(Request $request){

		try {

			PisciculturaValidator::validate($request->all());

			$piscicultura = \nemo\Piscicultura::create($request->all());

			$gerenciar = \nemo\Gerenciar::create([
				'user_id' => (int) \Auth::user()->id,
				'piscicultura_id' => $piscicultura->id,
			]);

			return redirect()->route('piscicultura.listar');

		}catch(\nemo\Validator\ValidationException $e){

			return back()->withErrors($e->getValidator())->withInput();
			
		}

    }

    public function editar($id){
		$piscicultura = \nemo\Piscicultura::find($id);
		return view("editarPiscicultura", ['piscicultura' => $piscicultura]);
    }

    public function salvar(Request $request){
		$piscicultura = \nemo\Piscicultura::find($request->id);

		if($piscicultura->nome == $request['nome']){
			return redirect()->route('piscicultura.listar');;
		}

		$piscicultura->nome = $request['nome'];
		$dados = array_values(((array) $piscicultura))[12];
		
		try {
			PisciculturaValidator::validate($dados);
			$piscicultura->update();
			
			return redirect()->route('piscicultura.listar');;			

		}catch(\nemo\Validator\ValidationException $e){
			return back()->withErrors($e->getValidator())->withInput();
		}

    }

    public function remover($id){
		    $piscicultura = \nemo\Piscicultura::find($id);
		    $piscicultura->delete();
		return redirect()->route('piscicultura.listar');
		}
		
		public function relatoriosPesca($id){
			$piscicultura = \nemo\Piscicultura::find($id);
			$tanques = $piscicultura->tanques;
			//dd($tanques);
			return view("relatoriosPescas", ['piscicultura' => $piscicultura, 'tanques'=> $tanques]);
			}

			public function graficosPesca($id){
				$ciclo = \nemo\Ciclo::find($id);
				$tanque = $ciclo->tanque;
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
    $pesca = $ciclo->pesca;

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
							

				return view('graficosPescas', compact('line_chartBiometria','line_chartsAmoniaNitritoNitrato','line_chartsDurezaAlcalinidade','line_chartOxigenio','line_chartPh', 'line_chartTemp'), ['tanque' => $tanque, 'piscicultura' => $piscicultura,'povoamento'=>$povoamento,'pesca'=>$pesca]);
			
				}

				public function gerarDatas($qualidades){
					$datas = array();
					
					foreach ($qualidades as &$qualidade) {
						$dataHora = $qualidade->data . " " . $qualidade->hora;
						$str = str_replace("-", "/", $dataHora);
						$str = date("d/m/Y h:i:s", strtotime($str));
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
							$str = date("d/m/Y h:i:s", strtotime($str));
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
							$str = date("d/m/Y h:i:s", strtotime($str));
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
							$str = date("d/m/Y h:i:s", strtotime($str));
							if($data == $str){
								array_push($pesosDatas,$pesca->peso); 
							}
						}
					}
					return $pesosDatas;
				}

    

}
