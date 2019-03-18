

@extends('layouts.principal')
@section('title','Listar Pisciculturas')
@section('path')
	Listar Pisciculturas
@stop
@section('content')
	<div>
		<form action="/cadastrar/piscicultura" method="get" >
			<input type="submit" value="Nova Piscicultura" class="btn btn-primary" />
		</form>
	</div>	
	<div>
		<table class="table">
			<tr>
				<th>Nome</th>
			</tr>
			@foreach ($pisciculturas as $piscicultura)
			<tr>
				<td><a href="/info/piscicultura/{{$piscicultura->id}}">{{ $piscicultura->nome }}</a></td>
			</tr>
			@endforeach		
		</table>
	</div>
@stop