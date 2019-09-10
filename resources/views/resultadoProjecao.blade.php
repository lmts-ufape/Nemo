@extends('layouts.principal')
@section('title','Projecao de Produção')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > 
<a href="{{ route("projecao.chamar", ["id" => $piscicultura->id]) }}"> Calcular Projecao</a> > Resultado do Escalonamento da Produção    
@stop
@section('content')
    <div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
                    Resultado da Projeção
				</div>
				<div class="card-body">
					<div class="form-group">
                        <label><strong>Quantidade de Tanques: </strong></label>
                        {{$tanquesNecessarios}}<br>
                        <label><strong>Volume Necessário por Tanque: </strong></label>
                        {{$volumeMinimo}} litros
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop