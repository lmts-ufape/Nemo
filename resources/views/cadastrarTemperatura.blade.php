@extends('layouts.principal')
@section('title','Cadastrar Temperatura')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}"> Tanques </a> > Temperatura	
@stop
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                  Cadastrar Temperatura
              </div>
              <div class="card-body">
                <form action="/adicionarTemperatura" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="id_tanque" value="{{$tanque->id}}" />
                  <input type="hidden" name="id_qualidade_agua" value="{{$qualidade_agua->id}}" />
                  <div class="form-group">
                    <label>Valor</label>
                    <input class="form-control" type="number" name="valor"  value="{{old('ph')}}" autofocus/><br/>
                    <label>Data da Medição</label>
                    <input class="form-control" type="date" name="data" value="{{old('data')}}" placeholder="DD/MM/AA" autofocus /><br/>
                    <label>Hora da Medição</label>
                    <input class="form-control" type="time" name="hora" value="{{old('hora')}}" placeholder="HH:MM" autofocus /><br/>
                  </div>
                  <input class="btn btn-success" type="submit" value="Cadastrar" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@stop
