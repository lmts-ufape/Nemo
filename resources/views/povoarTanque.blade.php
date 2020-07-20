

<!doctype html>
@extends('layouts.principal')
@section('title','Povoar Tanque')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}">Tanques</a>  > Povoamento
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
					@if($errors->getMessages() != NULL)
                	<div class="alert alert-danger" role="alert">
                  		@foreach($errors->getMessages() as &$error) {{$error[0]}} <br/> @endforeach
               		</div>
              		@endif
					<form action="{{route('povoamento.inserir.peixe')}}" method="post">
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
							<input class="form-control" type="text" min="0" name="quantidade" />
							<label>Peso total (Kg)</label>
							<input class="form-control" type="text" step="0.0001" name="peso" autofocus/><br/>
						</div>
						<input class="btn btn-primary" type="submit" value="Adicionar ao tanque" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
