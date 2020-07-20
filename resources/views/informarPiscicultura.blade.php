@extends('layouts.principal')
@section('title','Ações Piscicultura')
@section('path')
    <a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > {{$piscicultura->nome}} > Dados
@stop
@section('content')
<div class="container" width="50%">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$piscicultura->nome}}
                    </div>
                    <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}">Gerenciar Tanques</a>
                                    </td>
                                    @if($dono == True)
                                        @if($quantidade_gerenciadores > 0)
                                        <td>
                                            <a class="btn btn-primary" href="{{ route("gerenciador.listar", ["id" => $piscicultura->id]) }}">Gerenciar Permissoes</a>
                                        </td>
                                        @else
                                        <td>
                                            <a class="btn btn-primary" href="{{ route("gerenciador.listar", ["id" => $piscicultura->id]) }}">Gerenciar Permissoes</a>
                                        </td>
                                        @endif
                                    @endif
                                    <td>
                                        <a class="btn btn-primary"  href="{{ route("escalonamento.chamar", ["id" => $piscicultura->id]) }}">Escalonamento de Produção</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="btn btn-primary" href="{{route("projecao.chamar", ["id"=>$piscicultura->id])}}">Projeção de Produção</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route("piscicultura.pesca.relatorios", ["id" => $piscicultura->id]) }}">Relatórios de Despesca</a>
                                    </td>
                                </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@stop
