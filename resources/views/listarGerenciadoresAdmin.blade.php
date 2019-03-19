@extends('layouts.principal')
@section('title','Gerenciadores')
@section('path')
	<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > Gerenciadores
	
@stop
@section('content')
	<ul>
	
		<table class="table">
				<tr>
					<th>Administrador</th>
				</tr>
				<tr>
					<td>{{ $admin->name }}</td>					
				</tr>
			</table>
		
			<table class="table">
				<tr>
					<th>Gerenciadores</th>
					<th>Ação</th>
				</tr>
				@foreach ($gerenciadores as $gerenciador)
				<tr>
					<td>{{ $gerenciador->name }}</td>
					<td><a class="btn btn-danger"  href="/remover/gerenciador/{{$gerenciador->id}}/piscicultura/{{$piscicultura_id}}">Remover</td>
				</tr>
				@endforeach
			</table>
		
		
		<br>
		<br>
		<a class="btn btn-primary" href="/adicionar/gerenciador/piscicultura/{{$piscicultura_id}}">Adicionar novo gerenciador</a>
	</ul>	
@stop

