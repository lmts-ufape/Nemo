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


          
    

    return view('relatoriosTanque', compact('line_chartNitrato','line_chartNitrito','line_chartDureza','line_chartAlcalinidade','line_chartOxigenio','line_chartPh', 'line_chartTemp', 'line_chartAmonia'), ['tanque' => $tanque, 'piscicultura' => $piscicultura]);
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
    $phsData = array();
    foreach($datas as &$data){
      foreach($qualidades as &$qualidade){
        $dataHora = $qualidade->data . " " . $qualidade->hora;
        $str = str_replace("-", "/", $dataHora);
        if($data == $str){
          array_push($phsData,$qualidade->valor); 
        }
      }
    }
    return $phsData;
  }

}

