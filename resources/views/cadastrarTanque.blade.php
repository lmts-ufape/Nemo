@extends('layouts.principal')
@section('title','Cadastrar Tanque')
@section('path')
  <a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}" > Tanques </a> > Cadastrar Tanque
@stop
@section('conteudo')
  <form action="/adicionarTanque" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id_piscicultura" value="{{$piscicultura->id}}">
    <div class="form-group">
      <label>Nome</label>
      <input class="form-control" type="text" name="nome"required="required" placeholder="nome" autofocus required /><br/>
      <label>Volume</label>
      <input class="form-control" type="number" min="0" step="any" name="volume" placeholder="Em litros" autofocus required/><br/>
      <label>Área</label>
      <input class="form-control" type="number" min="0" step="any" name="area" placeholder="Em metros quadrados" autofocus required/><br/>
      <label>Altura</label>
      <input class="form-control" type="number" min="0" step="any" name="altura" placeholder="Em metros" autofocus required/><br/>
      <input class="btn btn-success" type="submit" value="Cadastrar" />
  </form>
@stop
