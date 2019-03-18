

<!doctype html>
@extends('layouts.principal')
@section('title','Povoar Tanque')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > <a href="/listar/especies/{{$especiePeixe->id}}">Povoar Tanque</a> > Povoamento		
@stop
@section('content')

@if (isset($errors) && count($errors) > 0)
<div class="alert alert-danger" role="alert">
	@foreach($errors->getMessages() as &$error)
		{{$error[0]}}
	@endforeach
</div>
<div class="container">
	
		<div class="card">
			<div class="card-header">Povoar</div>
			<div class="card-body">
				
				<form action="/inserirPeixe" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="id_tanque" value="{{$tanque->id}}">
					<input type="hidden" name="id_especie" value="{{$especiePeixe->id}}">
					<input type="hidden" name="warning" value="1">
					<div class="form-group">
						<label>Quantidade</label><br>	
						<input class="form-control" type="number" min="0" name="quantidade" required/>
					</div>
					<input class="btn btn-primary" type="submit" value="Adicionar ao tanque" />		
				</form>
			</div>
		</div>
	</div>
@else
<div class="container">
	
	<div class="card">
		<div class="card-header">Povoar</div>
		<div class="card-body">
			
			<form action="/inserirPeixe" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="id_tanque" value="{{$tanque->id}}">
				<input type="hidden" name="id_especie" value="{{$especiePeixe->id}}">
				<div class="form-group">
					<label>Quantidade</label><br>	
					<input class="form-control" type="number" min="0" name="quantidade" required/>
				</div>
				<input class="btn btn-primary" type="submit" value="Adicionar ao tanque" />		
			</form>
		</div>
	</div>
</div>

@endif
@stop