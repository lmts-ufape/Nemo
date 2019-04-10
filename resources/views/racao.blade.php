<!doctype html>
@extends('layouts.principal')
@section('title','Ração')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Ração
@stop
@section('content')
<div class="container" width="50%">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Ração          
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table">
                                <tr>
                                    <th>Proteína bruta</th>
                                    <th>Tamanho</th>
                                    <th>Quantidade por dia</th>
                                    <th>Refeições por dia</th>
                                    <th>Quantidade por refeição</th>
                                </tr>
                                <tr>
                                <td>{{ $pb }}</td>
                                <td>{{ $tamanho }}</td>
                                <td>{{ $quantidade_total }}</td>
                                <td>{{ $refeicoes_por_dia }}</td>
                                <td>{{ $quantidade_por_refeicao }}</td>
                                </tr>	
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
</div>
@stop