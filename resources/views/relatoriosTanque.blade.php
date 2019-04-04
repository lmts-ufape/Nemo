<!doctype html>
@extends('layouts.principal')
@section('title','Relatórios do Tanque')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Relatórios do Tanque
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Relatório da Qualidade da água</div>
                <div class="card-body">
				    <div id="tabela" class="table-responsive">
                        
                        {{--
                          <table id="tabela" class="table table-hover" >
                            <thead>
                                <tr>
                                    <th>PH</th>
                                    <th>Nível Oxigênio</th>
                                    <th>Temperatura</th>
                                    <th>Nível Amônia</th>
                                    <th>Nitrito</th>
                                    <th>Nitrato</th>
                                    <th>Alcalinidade</th>
                                    <th>Dureza</th>
                                </tr>
                            </thead>
                        <tbody>
                          @foreach ($tanque->qualidade_aguas as $qualidadeAgua)
                            <tr>
                              <td data-title="PH">{{ $qualidadeAgua->ph}}</td>
                              <td data-title="Nível Oxigênio">{{ $qualidadeAgua->nivelOxigenio}}</td>
                              <td data-title="Temperatura">{{ $qualidadeAgua->temperatura}}</td>
                              <td data-title="Nível de Amônia">{{ $qualidadeAgua->nivelAmonia}}</td>
                              <td data-title="Nitrito">{{ $qualidadeAgua->nitrito}}</td>
                              <td data-title="Nitrato">{{ $qualidadeAgua->nitrato}}</td>
                              <td data-title="Alcalinidade">{{ $qualidadeAgua->alcalinidade}}</td>
                              <td data-title="Dureza">{{ $qualidadeAgua->dureza}}</td>
                            </tr>
                            <tr>
                                <td colspan="8" data-title="Data da Medição">Data: {{ $qualidadeAgua->data}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      </font>
                      </div>
                    </div>
                    <div class="card-header">Relatório de Povoamento</div>
                        <div class="card-body">
				            <div id="tabela" class="table-responsive">
                            <font size="2px">
                            <table id="tabela" class="table table-hover" >
                            </table>
                          --}}
                          {!! $chart->html() !!}
                      
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@stop