@extends('layouts.principal')
@section('title','Escalonamento de Produção')
@section('path')
	<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > Escalonamento de Produção    
@stop
@section('content')
@if (isset($errors) && count($errors) > 0)
<div class="alert alert-danger" role="alert">
	@foreach($errors->getMessages() as &$error)
		{{$error[0]}}
		<br>
	@endforeach
</div>
@endif
	<div class='container'>
		<form action="/calcularEscalonamento" method="post">
			@csrf
			<input type="hidden" value="{{$piscicultura->id}}" name="piscicultura_id">
			
			<div class="form-group">
				<label>Volume dos tanques utilizados</label>
				<input class="form-control" type="text" name="volume" value="{{old('volume')}}" autofocus/>
			</div>
			<div class="form-group">
				<label>Quantidade de peixes por produção</label>
				<input class="form-control" type="text" name="quantidade_peixes" value="{{old('quantidade_peixes')}}">
			</div>
			<div class="form-group">
				<label>Periodicidade</label>
				<select class="custom-select" name="periodicidade">
					<option selected>Selecione a periodicidade</option>
					<option value="7">7 dias</option>
					<option value="15">15 dias</option>
					<option value="30">30 dias</option>
				</select>
			</div>
			<div class="form-group">
					<label>Espécie do Peixe</label>
					<select class="custom-select" name="especie">
						<option selected>Selecione a espécie</option>
						@foreach ($especiePeixe as $especie)
							<option value="{{$especie->id}}">{{$especie->nome}}</option>
						@endforeach
					</select>
				</div>
			<input class="btn btn-primary" type="submit" value="Calcular"/>
		</form>
	</div>
@stop