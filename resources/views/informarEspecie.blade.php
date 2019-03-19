@extends('layouts.principal')
@section('title','Info Especie')
@section('path')
	Piscicultura {{$piscicultura->nome}} > Tanque {{$tanque->id}} > Povoar > Informação da espécie: {{$EspeciePeixe->nome}}
@stop
@section('content')
    
	<div>
		<table class="table">
			<tr>
				<th>{{ $EspeciePeixe->nome}}</th>				
			</tr>
			<tr>
				<td>
						<table class="table">
							<tr>
								<th>Tempo de desenvolvimento</th>
								<th>Tipo de ração</th>
								<th>Temperatura ideal da água</th>
								<th>Quantidade de peixes por volume</th>
								<th>Ações</th>
							</tr>
							<tr>
								<td>{{ $EspeciePeixe->tempo_desenvolvimento}} meses</td>
								<td>{{ $EspeciePeixe->tipo_racao}}</td>
								<td>{{ $EspeciePeixe->temperatura_ideal_agua}} graus</td>
								<td>{{ $EspeciePeixe->quantidade_por_volume}}</td>
								<td>
									<a class="btn btn-warning" href="/editar/tanque/{{$tanque->id}}/especie/{{$EspeciePeixe->id}}">Editar</a>
									<a class="btn btn-danger" href="/remover/tanque/{{$tanque->id}}/especie/{{$EspeciePeixe->id}}">Remover</a>
								</td>
							</tr>
						</table>  
							
			</tr>
					
		</table>
	</div>
@stop