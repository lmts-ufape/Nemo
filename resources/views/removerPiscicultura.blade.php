<!doctype html>
@extends('layouts.principal')
@section('title','Remover Piscicultura')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > Remover Piscicultura	
@stop
@section('content')
	<form action="/apagarPiscicultura" method="post" >
		{{ csrf_field() }}
		<input type="hidden" name="id" value=" {{ $piscicultura->id}}"/>
		<input type="hidden" name="id" value="{{$piscicultura->id}}"/>
		<div class="form-group">
			<label>Nome da Piscultura</label><br>	
			<input type='form-group' disabled="disabled" name="nome" value="{{$piscicultura->nome}}"/>
		</div>
		<input type="submit" class="btn btn-primary" value="Remover" />
	</form>
@stop

