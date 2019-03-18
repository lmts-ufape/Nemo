<!doctype html>
@extends('layouts.principal')
@section('title','Informações de Tanque')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Povoar Tanque	
@stop
@section('content')
	<div>
		<form action="/adicionar/especie/{{$piscicultura_id}}" method="get" >
			<input class="btn btn-primary" type="submit" value="Nova Especie" />
		</form>
	</div>	

	<div>
		<table class="table">
			<tr>
				<th>Nome</th>
				<th>Ação</th>
			</tr>
			@foreach ($listaEspecies as $EspeciePeixe)
			<tr>
				<td><a href="/tanque/{{$id}}/especie/{{$EspeciePeixe->id}}/info">{{ $EspeciePeixe->nome}}</a></td>
				<td>					
					<a class="btn btn-primary" href="/povoar/tanque/{{$id}}/especie/{{$EspeciePeixe->id}}">Adicionar ao tanque</a>
				</td>
			</tr>
			@endforeach		
		</table>
	</div>
@stop



