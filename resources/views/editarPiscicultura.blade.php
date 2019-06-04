<!doctype html>
@extends('layouts.principal')
@section('title','Editar Piscucultura')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a>  > Editar {{$piscicultura->nome}}	
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Piscicultura
				</div>
				<div class="card-body">
					@if (isset($errors) && count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						@foreach($errors->getMessages() as &$error)
							{{$error[0]}}
						@endforeach
					</div>
					@endif

					<form action="/salvarPiscicultura" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{$piscicultura->id}}"/>
						<div class="form-group">
							<label>Nome da Piscultura</label><br>	
							<input type="form-control" name="nome" value="{{$piscicultura->nome}}" />
						</div>
						<input class="btn btn-primary" type="submit" value="Alterar" />		
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop


