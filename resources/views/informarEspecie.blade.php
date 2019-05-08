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
							</tr>
							<tr>
								<td>{{ $EspeciePeixe->tempo_desenvolvimento}} meses</td>
								<td>{{ $EspeciePeixe->tipo_racao}}</td>
								<td>{{ $EspeciePeixe->temperatura_ideal_agua}} graus</td>
								<td>{{ $EspeciePeixe->quantidade_por_volume}}</td>
								
							</tr>
						</table>  
							
			</tr>
					
		</table>
	</div>
@stop