@extends('layouts.principal')
@section('title','Escalonamento de Produção')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/escalonamento/{{$piscicultura->id}}">Calcular Escalonamento</a> > Resultado do Escalonamento da Produção    
@stop
@section('content')
    <div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
                    Resultado do Escalonamento
				</div>
				<div class="card-body">
					<div>
						<table class="table">							
							<tr>
                                <th>Data</th>
                                <th>Ação</th>
                                <th>Tanque</th>
                                <th>Quantidade Povoamento</th>
                            </tr>
							@for($i = 0; $i < count($datas); $i++)
                            <tr>
                                <td>{{date("d/m/Y", strtotime($datas[$i]))}}</td>
                                <td>{{$acoes[$i]}}</td>
                                <td>{{$tanquesEscalonamento[$i]}}</td>
                                <td>{{$quantidadePov[$i]}}</td>
							</tr>
							@endfor
							@for($j = 0; $j < count($datasPesca); $j++)
							<tr>
                                <td>{{date("d/m/Y", strtotime($datasPesca[$j]))}}</td>
                                <td>Despesca</td>
                                <td>{{$tanquesEscalonamento[$j]}}</td>
                                <td>-</td>
							</tr>
							@endfor	
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop