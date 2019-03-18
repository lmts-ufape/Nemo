<!doctype html>
@extends('layouts.principal')
@section('title','Editar Especie')
@section('path')
	Piscultura {{$piscicultura->nome}} > Tanque {{$tanque_id}} > Povoar > Informações da especie: {{$especiePeixe->nome}} > Remover
@stop
@section('content')
	<form action="/apagarEspecie" method="post"> 
		{{ csrf_field() }}
		<input type="hidden" name="especie_id" value="{{ $especie_id}}" />
    	<input type="hidden" name="tanque_id" value="{{ $tanque_id}}" />
		<div class="form-group">
			<label>Especie</label><br>	
			<input class="form-control" type="text" disabled="disabled" name="nome" value="{{$especiePeixe->nome}}"/>
		</div>
		<input type="submit" class="btn btn-danger" value="Remover" />
	</form>
@stop

