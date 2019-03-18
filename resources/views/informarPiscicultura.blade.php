@extends('layouts.principal')
@section('title','Editar Tanque')
@section('path')
    <a href="/listar/pisciculturas">Pisciculturas</a> > {{$piscicultura->nome}} > Dados
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <a class="btn btn-primary" href="/listar/tanques/{{$piscicultura->id}}">Gerenciar Tanques</a>
                <br>
                @if($quantidade_tanques > 1)
                <label>
                    Essa piscicultura possui {{$quantidade_tanques}} tanques.
                </label> 
                @elseif($quantidade_tanques == 0)
                <label>
                    Essa piscicultura não possui tanques.
                </label>
                @else
                <label>
                    Essa piscicultura possui {{$quantidade_tanques}} tanque.
                </label>
                @endif
            </div>
            @if($dono == True)
            <div class="col-sm">
                @if($quantidade_gerenciadores > 0)
                <a class="btn btn-primary" href="/listar/gerenciadores/piscicultura/{{$piscicultura->id}}">Gerenciar Permissoes</a>
                <br>
                <label>
                    Essa piscicultura possui {{$quantidade_gerenciadores}} gerenciador(es).
                </label>
                @else
                <a class="btn btn-primary" href="/listar/gerenciadores/piscicultura/{{$piscicultura->id}}">Gerenciar Permissoes</a>
                <br>
                <label>
                    Essa piscicultura não possui outros gerenciadores.
                </label>
                @endif
            </div>
            <div class="col-sm">
                <a class="btn btn-warning" href="/editar/pisciculturas/{{$piscicultura->id}}">Editar Piscicultura</a>
                <br>
                <label>
                    Altere dados básicos da sua piscicultura
                </label>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm">
                @if($dono == True)
                <a class="btn btn-danger" href="/remover/piscicultura/{{$piscicultura->id}}">Excluir Piscicultura</a>
                <br>
                <label>
                    Excluir a piscicultura não é reversível.
                </label>
                @else
                <a class="btn btn-danger" href="/remover/gerenciador/{{$user_id}}/piscicultura/{{$piscicultura->id}}">Sair da Piscicultura</a>
                <br>
                <label>
                    Essa ação só pode ser revertida pelo Administrador.
                </label>
                @endif
            </div>
            <div class="col-sm">
                <a class="btn btn-primary" href="/escalonamento/{{$piscicultura->id}}">Escalonamento de Produção</a>
                <br>
                <label>
                    Calcule um escalonamento para sua produção.
                </label>
            </div>
            <div class="col-sm">
                <!--
                    Coluna criada apenas para organização de layout
                -->
            </div>
        </div>
    </div>

    <div>
        
    </div>
@stop