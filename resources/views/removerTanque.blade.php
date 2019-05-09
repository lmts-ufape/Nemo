@extends('layouts.principal')
@section('title','Remover Tanque')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Remover Tanque	
@stop
@section('content')
  <form action="/apagarTanque" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="tanque_id" value="{{$tanque->id}}"/>
    <input type="hidden" name="piscicultura_id" value="{{ $piscicultura->id}}" />
    <div class="form-group">
      <label>ID</label>
      <input class="form-control" type="text" disabled="disabled" name="id" value="{{$tanque->id}}"><br/>
      <label>Volume</label>
      <input class="form-control" type="text" disabled="disabled" name="volume" value="{{$tanque->volume}}"><br/>
      <label>Piscicultura pertencente</label>
      <input class="form-control" type="text" disabled="disabled" name="nome_piscicultura" value="{{ $piscicultura->nome }}"><br/>
      <label>Necessária Manutenção:</label> <input type="text" name="manutencao_necessaria" disabled="disabled" value="{{$tanque->manutencao_necessaria}}"><br/>
    </div>
    <input class="btn btn-primary" type="submit" value="Remover" />
  </form>
@stop