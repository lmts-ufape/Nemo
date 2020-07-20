<!doctype html>
@extends('layouts.principal')
@section('title','Informações de Tanque')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}"> Tanques </a> > Povoar Tanque
@stop
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Espécies
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<th>Nome</th>
							<th>Ação</th>
						</tr>
						@foreach ($listaEspecies as $EspeciePeixe)
						<tr>
							<td>{{ $EspeciePeixe->nome}}</td>
							<td>
								<a class="btn btn-primary" href="{{ route("povoamento.povoar", ["id" => $id,"especie_id"=>$EspeciePeixe->id]) }}">Adicionar ao tanque</a>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
