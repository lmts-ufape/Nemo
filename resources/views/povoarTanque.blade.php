

<!doctype html>
@extends('layouts.principal')
@section('title','Povoar Tanque')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > <a href="/listar/especies/{{$especiePeixe->id}}">Povoar Tanque</a> > Povoamento		
@stop
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Povoar
				</div>
				<div class="card-body">				
				@if (isset($errors) && count($errors) > 0)
				<div class="alert alert-danger" role="alert">
					@foreach($errors->getMessages() as &$error)
						{{$error[0]}}
					@endforeach
				</div>
					<form action="/inserirPeixe" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="id_tanque" value="{{$tanque->id}}">
						<input type="hidden" name="id_especie" value="{{$especiePeixe->id}}">
						<input type="hidden" name="warning" value="1">
						<div class="form-group">
							<label>Data</label>
						<input class="form-control" type="date" name="data" value="{{$data_atual}}" placeholder="DD/MM/AA" autofocus /><br/>
							<label>Hora</label>
							<input class="form-control" type="time" step="1" name="hora" value="{{$hora_atual}}" placeholder="HH:MM:SS" autofocus /><br/>
							<label>Quantidade (unidade)</label><br>	
							<input class="form-control" type="number" min="0" name="quantidade" required/>
							<label>Peso total (Kg)</label>
							<input class="form-control" type="number" step="0.0001" name="peso" autofocus/><br/>
						</div>
						<input class="btn btn-primary" type="submit" value="Adicionar ao tanque" />		
					</form>
				@else			
					<form action="/inserirPeixe" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="id_tanque" value="{{$tanque->id}}">
						<input type="hidden" name="id_especie" value="{{$especiePeixe->id}}">
						<div class="form-group">
							<label>Data</label>
							<input class="form-control" type="date" name="data" value="{{$data_atual}}" placeholder="DD/MM/AA" autofocus /><br/>
							<label>Hora</label>
							<input class="form-control" type="time" name="hora" value="{{$hora_atual}}" placeholder="HH:MM" autofocus /><br/>
							<label>Quantidade (unidade)</label><br>	
							<input class="form-control" type="number" min="0" name="quantidade" required/>
							<label>Peso total (Kg)</label>
							<input class="form-control" type="number" step="0.0001" name="peso" autofocus/><br/>
						</div>
						<input class="btn btn-primary" type="submit" value="Adicionar" />		
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endif
@stop