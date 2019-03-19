@extends('layouts.principal')
@section('title','Escalonamento de Produção')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/escalonamento/{{$piscicultura->id}}">Calcular Escalonamento</a> > Resultado do Escalonamento da Produção    
@stop
@section('content')
    <div>
        <table class="table">
            <tr>
                <th>Produção por ciclo</th>
                <th>Periodicidade</th>
                <th>Duração do ciclo</th>
                <th>Volume dos tanques</th>
                <th>Tanques necessários</th>
            </tr>
            <tr>
                <td>{{$producaoPorCiclo}}</td>
                <td>{{$periodicidade}} Dias</td>
                <td>{{$duracaoCiclo}} Meses</td>
                <td>{{$volumeTanque}}</td>
                <td>{{$tanquesNecessarios}}</td>
            </tr>
        </table>
    </div>
@stop