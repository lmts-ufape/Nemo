@extends('layouts.principal')
@section('title','Pesca')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}"> Tanques </a> > Pescar	
@stop
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                  Pescar
              </div>
              <div class="card-body">
                <form action="/pescar" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="id_tanque" value="{{$tanque->id}}" />
                  <div class="form-group">
                    <label>Data da Pesca</label>
                    <input class="form-control" type="date" name="data" value="{{$data_atual}}" placeholder="DD/MM/AA" autofocus /><br/>
                    <label>Hora da Pesca</label>
                    <input class="form-control" type="time" step="1" name="hora" value="{{$hora_atual}}" placeholder="HH:MM" autofocus /><br/>
                    <label>Peso total da pesca (kg)</label>
                    <input class="form-control" type="number" name="valor" min="0" value="{{old('peso')}}" autofocus/><br/>
                  </div>
                  <input class="btn btn-success" type="submit" value="Cadastrar" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@stop
