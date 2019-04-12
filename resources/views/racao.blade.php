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
                            <table class="table" >
                                <tr>
                                    <th align ="center">Proteína bruta</th>
                                    <th align ="center">Tamanho</th>
                                    <th align ="center">Quantidade por dia</th>
                                    <th align ="center">Refeições por dia</th>
                                </tr>
                                <tr>
                                <td align ="center">{{ $pb }}</td>
                                <td align ="center">{{ $tamanho }}</td>
                                <td align ="center">{{ $quantidade_total }}g</td>
                                <td align ="center">{{ $refeicoes_por_dia }}</td>
                                </tr>	
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
</div>
@stop