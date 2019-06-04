<!doctype html>
@extends('layouts.principal')
@section('title','Detalhe dos Tanques')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}"> Tanques </a> > Detalhes do Tanque
@stop
@section('content')
<div class="container" width="50%">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Detalhes
                        <a href="{{ route("tanque.remover", ["id" => $tanque->id]) }}">
                            <img onclick="return confirm('Confirmar remoção de {{ $tanque->nome}}?')" src="{{asset('images/lixo_sem_fundo.png')}}" style = "margin-left: 30px; margin-right: -10px " height="25" width="25" align = "right">
                        </a>
                        <a href="{{ route("tanque.editar", ["id" => $tanque->id]) }}">
                            <img src="{{asset('images/edit.png')}}" style = "margin-left: 15px; margin-right: -10px " height="25" width="25" align = "right">
                        </a>                    
                    
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table">
                                <tr>
                                    <th>Nome</th>
                                    <th>Volume</th>
                                    <th>Área</th>
                                    <th>Altura</th>
                                </tr>
                                <tr>
                                <td>{{ $tanque->nome }}</td>
                                <td>{{ $tanque->volume }}</td>
                                <td>{{ $tanque->area }}</td>
                                <td>{{ $tanque->altura }}</td>
                                </tr>	
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
</div>
@stop