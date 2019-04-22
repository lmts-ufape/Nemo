@extends('layouts.principal')
@section('title','Pesca')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Pescar	
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
                    <label>Peso</label>
                    <input class="form-control" type="number" name="valor" min="0" value="{{old('peso')}}" autofocus/><br/>
                    <label>Data da Pesca</label>
                    <input class="form-control" type="date" name="data" value="{{old('data')}}" placeholder="DD/MM/AA" autofocus /><br/>
                    <label>Hora da Pesca</label>
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
