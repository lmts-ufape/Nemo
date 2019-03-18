@extends('layouts.principal')
@section('title','Adicionar Gerenciador')
@section('path')
	<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > Adicionar Gerenciador
@stop
@section('content')
@if (isset($errors) && count($errors) > 0)
<div class="alert alert-danger" role="alert">
	@foreach($errors->getMessages() as &$error)
		{{$error[0]}}
	@endforeach
</div>
@endif
<form action="/inserirGerenciador" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="is_adiministrador" value=0>
  <input type="hidden" name="piscicultura_id" value="{{$piscicultura->id}}">
  <div class="form-group">
    <label>Endereço de e-mail</label>
    <input type="email" class="form-control" name="email" placeholder="exemplo@exemplo.com" value="{{old('email')}}" required>
  </div>
  <button type="submit" class="btn btn-primary">Adicionar</button>
</form>
@stop