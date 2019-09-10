<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use nemo\Validator\QualidadeAguaValidator;
use nemo\Http\Controllers\PhController;
use nemo\Http\Controllers\TemperaturaController;
use nemo\Http\Controllers\NitratoController;
use nemo\Http\Controllers\NitritoController;
use nemo\Http\Controllers\DurezaController;
use nemo\Http\Controllers\AlcalinidadeController;
use nemo\Http\Controllers\AmoniaController;
use nemo\Http\Controllers\OxigenioController;


class QualidadeAguaController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

    public function cadastrar($tanque_id){
    	$tanque = \nemo\Tanque::find($tanque_id);
    	$idPiscultura = $tanque->piscicultura_id;
      $piscicultura = \nemo\Piscicultura::find($idPiscultura);
			date_default_timezone_set('America/Sao_Paulo');
      $data = date('Y-m-d');
      $hora = date('H:i:s');
    
    	  	
    	return view("cadastrarQualidadeAgua",['data_atual'=>$data,'hora_atual'=>$hora,'tanque_id'=>$tanque_id,'tanque' => $tanque,'piscicultura' => $piscicultura]);
  }

  public function adicionar(Request $request){
    $tanque = \nemo\Tanque::find($request->id_tanque);
    $piscicultura = $tanque->piscicultura;
    $qualidade_agua = $tanque->qualidade_aguas;
    $data = $request->data.' '.$request->hora;
    if($request->ph != null){
      PhController::cadastrar($request);
    }if($request->temperatura != null){
      TemperaturaController::cadastrar($request);
    }if($request->oxigenio != null){
      OxigenioController::cadastrar($request);
    }if($request->amonia != null){
      AmoniaController::cadastrar($request);
    }if($request->nitrato != null){
      NitratoController::cadastrar($request);
    }if($request->nitrito != null){
      NitritoController::cadastrar($request);
    }if($request->dureza != null){
      DurezaController::cadastrar($request);
    }if($request->alcalinidade != null){
      AlcalinidadeController::cadastrar($request);
    }
    return redirect()->route("tanque.listar", ['piscicultura' => $piscicultura->id]);
  }
  
  public function verificaTanqueExistente($id){
    $tanque= \nemo\Tanque::where('id','=',$id)->first();
    return empty($tanque);
  }
  
 	public function listar ($id) {
			$qualidadeAgua= \nemo\QualidadeAgua::all();
			$tanque= \nemo\Tanque::find($id);
			return view("listarQualidadeAgua", ['listaQualidadesAgua' => $qualidadeAgua,'id'=>$id]);    	
    }
    
    public function editar($id) {
		$qualidadeAgua = \nemo\QualidadeAgua::find($id);
  		return view("editarQualidadeAgua", ['qualidadeAgua' => $qualidadeAgua]);
  }

  public function salvar(Request $request){
	 	$qualidadeAgua = \nemo\QualidadeAgua::find($request->id);
  		$qualidadeAgua ->ph = $request->ph;
  		$qualidadeAgua->update();
  		return redirect()->route('qualidade.agua.listar');
  }
  
  public function remover(Request $request){
  		$qualidadeAgua = \nemo\QualidadeAgua::find($request->id);
    	return view("/removerQualidadeAgua", ['qualidadeAgua' => $qualidadeAgua]);
	}
	
	 public function apagar(Request $request){
  		$qualidadeAgua = \nemo\QualidadeAgua::find($request->id);
    	$qualidadeAgua->delete();
    	return redirect()->route('qualidade.agua.listar');
	}

}
