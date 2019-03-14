<!doctype html>
@extends('layouts.principal')
@section('title','Informações de Tanque')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Informações do Tanque
@stop
@section('conteudo')
		<div>
		
		<table class="table">
			<tr>
				<th>Espécie</th>
				<th>Quantidade</th>
				<th>Data de inserção</th>
				<th>Ações</th>				
			</tr>
						
			<?php
				$keys = array_keys($povoamentos);
			?>
			
			@foreach ($keys as $key)
			@foreach ($povoamentos[$key] as $povoamento)
			<tr>
				<td>{{$key}}</td>
				<td>{{$povoamento->quantidade}}</td>	
				<td>{{$povoamento->data}}</td>
				<td><a class="btn btn-primary" href="/tanque/{{$tanque->id}}/pesca/especie/{{$povoamento->especie_id}}/povoamento/{{$povoamento->id}}">Realizar pesca</a></td>
					
			</tr>
			@endforeach
			@endforeach
				
	</div>
	<div>
	<div>
		</table>
		<table class="table">
			<tr>
				<th>PH</th>
				<th>Data de inserção</th>
							
			</tr>						
			@foreach ($tanque->qualidade_aguas as $qualidade)		
			<tr>
				<td>{{$qualidade->ph}}</td>
				<td>{{$qualidade->data}}</td>	
				
					
			</tr>
			@endforeach
			
		</table>	
		
	</div>
	
	<div>
		</table>
		<table class="table">
			<tr>
				<th>Pesca</th>
				<th>Data da pesca</th>
				<th>Quantidade</th>
				<th>Peso</th>
							
			</tr>						
			@foreach ($tanque->pescas as $pesca)
			<?php
				$especiePeixe= \nemo\EspeciePeixe::find($pesca->especie_id);
			?>		
			<tr>
				<td>{{$especiePeixe->nome}}</td>
				<td>{{$pesca->data}}</td>
				<td>{{$pesca->quantidade}}</td>
				<td>{{$pesca->peso}}</td>	
				
					
			</tr>
			@endforeach
			
		</table>	
		
	</div>
	
	
@stop