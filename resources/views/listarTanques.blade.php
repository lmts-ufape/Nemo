<!doctype html>
@extends('layouts.principal')
@section('title','Listar Tanques')
@section('path')
	<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > Listagem de tanques
@stop
@section('content')
	<div>
		<form action="/cadastrar/tanque/{{$piscicultura->id}}" method="get" >
			<input class="btn btn-primary" type="submit" value="Novo Tanque" />
		</form>
	</div>	

	<div>
		<table class="table">
			<tr>
				<th>Tanque </th>
			</tr>
			@foreach ($tanques as $tanque)
			<tr>
			<td><a href="/tanque/{{$tanque->id}}/detalhes">{{ $tanque->nome }}</a></td>
				<td>
        			<a class="btn btn-primary" href="/info/tanque/{{$tanque->id}}">Info</a>
        			<a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/qualidadeAgua">Qualidade da água</a>
        			<a class="btn btn-primary" href="/listar/especies/{{$tanque->id}}">Povoar</a>
				</td>
			</tr>
			@endforeach		
		</table>
	</div>
@stop
