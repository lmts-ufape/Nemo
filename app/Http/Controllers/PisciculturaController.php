<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use nemo\Validator\PisciculturaValidator;

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

    

}
