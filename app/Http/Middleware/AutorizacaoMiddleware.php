<?php

namespace nemo\Http\Middleware;

use Closure;

class AutorizacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(\Auth::guest()){
            return redirect('login');
        }else{
            $rotas_gerentePiscicultura = [
                //Rotas de Piscicultura
                'info/piscicultura/{id}',
                //Rotas de Tanque
                'listar/tanques/{id}',
                'cadastrar/tanque/{id}',
                             
            ];
            $rotas_donoPiscicultura = [
                //Rotas de Gerenciadores
                'listar/gerenciadores/piscicultura/{id}',
                'adicionar/gerenciador/piscicultura/{id}',
                //Rotas de Piscicultura
                'editar/pisciculturas/{id}',
                'remover/piscicultura/{id}'                
            ];
            $rotas_gerenteTanque = [
                //Rotas de Tanque
                'editar/tanque/{id}',
                'remover/tanque/{id}',
                'tanque/{id}/detalhes',
                'relatorios/tanque/{id}',
                'tanque/{id}/detalhes',
                //Rotas de Qualidade Agua
                'tanque/{id}/cadastrar/qualidadeAgua',
                'tanque/{id}/listar/qualidadesAgua'
            ];

            if(in_array($request->route()->uri,$rotas_gerentePiscicultura)){

                $gerenciar = \nemo\Gerenciar::where('piscicultura_id','=',$request->id)->where('user_id','=',\Auth::user()->id)->first();
                if($gerenciar == NULL){
                    return redirect('/home')->with('denied','Você não tem permissão');
                }
            }
            elseif(in_array($request->route()->uri,$rotas_donoPiscicultura)){
                $gerenciar = \nemo\Gerenciar::where('piscicultura_id','=',$request->id)->where('user_id','=',\Auth::user()->id)->first();
                if($gerenciar==NULL||$gerenciar->is_administrador != "1"){
                    return redirect('/home')->with('denied','Você não tem permissão');
                }
            }elseif(in_array($request->route()->uri,$rotas_gerenteTanque)){
                $tanque = \nemo\Tanque::find($request->id);
                $piscicultura = $tanque->piscicultura;
                $gerenciar = \nemo\Gerenciar::where('piscicultura_id','=',$piscicultura->id)->where('user_id','=',\Auth::user()->id)->first();
                if($gerenciar == NULL){
                    return redirect('/home')->with('denied','Você não tem permissão');
                }
            }
            return $next($request);
        }
   
            
            
                 
    }
}
