<!doctype html>
@extends('layouts.principal')
@section('title','Ração')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Ração
@stop
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                            <div class="menu-direita-logout">
                                    Cálculo de Ração - {{$tanque->nome}}						
                                    <img onclick="return confirm('Esse cálculo foi realizado de acordo com a média de temperatura dos últimos 7 dias e com o peso médio da última biometria. ')" src="{{asset('images/info_white.png')}}" style = "margin-left: 30px; margin-right: -10px " height="25" width="25" align = "right">
                                
                            </div>         
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table" >
                                <tr>
                                    <th align ="center">Peso Vivo</th>
                                    <th align ="center">Temperatura</th>
                                    <th align ="center">Proteína bruta</th>
                                    <th align ="center">Tamanho</th>
                                    <th align ="center">Quantidade por dia</th>
                                    <th align ="center">Refeições por dia</th>
                                    <th align ="center">Quantidade por refeição</th>
                                </tr>
                                <tr>
                                    <td align ="center">{{ $pv/1000 }}Kg</td>
                                    <td align ="center">{{ $temperatura }}</td>
                                    <td align ="center">{{ $pb }}</td>
                                    <td align ="center">{{ $tamanho }}</td>
                                    <td align ="center">{{ $quantidade_total }}g</td>
                                    <td align ="center">{{ $refeicoes_por_dia }}</td>
                                    <td align ="center">{{ $quantidade_total/$refeicoes_por_dia }}g</td>                                    
                                </tr>	
                            </table>
                        </div>
                </div>
            </div>
        </div>	
</div>
@stop