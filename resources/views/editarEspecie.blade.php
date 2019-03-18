<!doctype html>
@extends('layouts.principal')
@section('title','Editar Especie')
@section('path')
	Piscultura {{$piscicultura->nome}} > Tanque {{$tanque_id}} > Povoar > Informações da especie: {{$especiePeixe->nome}} > Editar
@stop
@section('content')
	
	<form action="/salvarEspecie" method="post"> 
		{{ csrf_field() }}
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    	<input type="hidden" name="especie_id" value="{{ $especie_id}}" />
    	<input type="hidden" name="tanque_id" value="{{ $tanque_id}}" />
		<div class="form-group">
			<label>Nome</label><br>	
			<input class="form-control" step="any" type="text" name="nome"value="{{$especiePeixe->nome}}"required="required"/>
		</div>
		<div class="form-group">
			<label>Tempo de desenvolvimento em meses</label><br>	
			<input class="form-control" step="any" type="number" name="tempo_desenvolvimento"value="{{$especiePeixe->tempo_desenvolvimento}}"required="required"/>
		</div>
		<div class="form-group">
			<label>Tipo de Ração</label><br>	
			<input class="form-control" step="any" type="text" name="tipo_racao"value="{{$especiePeixe->tipo_racao}}"required="required"/>
		</div>
		<div class="form-group">
			<label>Temperatura ideal da água em graus</label><br>	
			<input class="form-control" step="any" type="number" name="temperatura_ideal_agua" value="{{$especiePeixe->temperatura_ideal_agua}}"required="required"/>
		</div>
		<div class="form-group">
			<label>Quantidade de peixes por litro</label><br>	
			<input class="form-control" step="any" type="number" name="quantidade_por_volume"value="{{$especiePeixe->quantidade_por_volume}}"required="required"/>
		</div>
		<input class="btn btn-primary" type="submit" value="Alterar" />		
	</form>
@stop