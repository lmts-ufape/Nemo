<?php

namespace nemo\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use nemo\Validator\GerenciarValidator;

class GerenciarController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function listarGerenciadores($id){
		$gerenciars = \nemo\Gerenciar::where('piscicultura_id','=',$id)->get();
		$piscicultura = \nemo\Piscicultura::find($id);

		$view = "listarGerenciadoresAdmin";

		$admin = NULL;
		$gerenciadores = array();

		foreach ($gerenciars as &$gerenciar) {
			$user = \nemo\User::find($gerenciar->user_id);
			if($gerenciar->is_administrador == '1'){
				$admin = $user;
			}else{
				array_push($gerenciadores,$user);
				if($user->id == \Auth::user()->id){
					$view = "listarGerenciadoresNotAdmin";
				}
			}
		}

		return view($view, [
			'admin' => $admin,
            'gerenciadores' => $gerenciadores,
            'piscicultura_id' => $id,
            'piscicultura' => $piscicultura,
		]);
    }
    
    public function adicionarGerenciador($id){
        $piscicultura = \nemo\Piscicultura::find($id);
        return view("adicionarGerenciador", ['piscicultura' => $piscicultura]);
    }

    public function inserirGerenciador(Request $request){
        try{
            GerenciarValidator::validate($request->all());


            $user = \nemo\User::where('email','=',$request->email)->first();
            $piscicultura = \nemo\Piscicultura::find($request->piscicultura_id);
    
            if($user == NULL){
                return view("adicionarGerenciador", ['piscicultura' => $piscicultura]);
            }
    
            $gerenciar = \nemo\Gerenciar::where('user_id','=',$user->id)->where('piscicultura_id','=',$piscicultura->id)->first();
            
            if($gerenciar != NULL){
                return view("adicionarGerenciador", ['piscicultura' => $piscicultura]);
            }
    
            $gerenciar = \nemo\Gerenciar::create([
                'user_id' => $user->id,
                'piscicultura_id' => $piscicultura->id,
                'is_administrador' => 0,
            ]);
        }catch(\nemo\Validator\ValidationException $e){
              
            return back()->withErrors($e->getValidator())->withInput();

        }

        return redirect()->route("gerenciador.listar", ['id' => $piscicultura->id]);

    }

    public function apagarGerenciador($user_id, $piscicultura_id){
        $gerenciar = \nemo\Gerenciar::where('user_id','=',$user_id)->where('piscicultura_id','=',$piscicultura_id)->first();
        $gerenciar->delete();

        if((int) $gerenciar->user_id == \Auth::user()->id){
            return redirect("gerenciador.listar");
        }

        return redirect()->route("gerenciador.listar", ['id' => $piscicultura_id]);
    }

}
