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
				</tr>
				@foreach ($gerenciadores as $gerenciador)			
				<tr>
					<td>{{ $gerenciador->name }}</td>
				</tr>			
				@endforeach
		</table>
		<br>
		<?php
			$user_id = \Auth::user()->id;
		?>
		<a class="btn btn-primary" href='/remover/gerenciador/{{$user_id}}/piscicultura/{{$piscicultura_id}}'>Me remover</a>
		<br>
	</ul>
@stop

