@extends('layouts.principal')
@section('title','Editar Tanque')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Editar Tanque
@stop
@section('conteudo')
  <form action="/salvarTanque" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" min="0" value="{{ $tanque->id}}" />
    <div class="form-group">
        <label>Nome</lable>
        <input class="form-control" step="any" type="text" name="nome"value="{{$tanque->nome}}"required="required"/><br/>
        <label>Volume</lable>
        <input class="form-control" type="number" step="any" name="volume" value="{{$tanque->volume}}" required/><br/>
        <label>Área</lable>
        <input class="form-control" type="number" step="any" name="area" value="{{$tanque->area}}" required/><br/>
        <label>Altura</lable>
        <input class="form-control" type="number" step="any" name="altura" value="{{$tanque->altura}}" required/><br/>
  
    </div>
    <div class="form-group">
      <label>Necessita de Manutenção</label>
      <div class="radio">
        <label><input type="radio" name="manutencao_necessaria" value="Não" checked>Não</label>
        <label><input type="radio" name="manutencao_necessaria" value="Sim">Sim</label>
      </div>
    </div>
    <input class="btn btn-primary" type="submit" value="Salvar" />
  </form>
@stop