<!doctype html>
@extends('layouts.principal')
@section('title','Listar Tanques')
@section('path')
	<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > Pescas
@stop
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">				
					Pescas				
				</div>
				<div class="card-body">
					<div>
						<table class="table">	
                            <tr>
                                <td>
                                    <label> Tanque</label>
                                </td>
                                <td>
                                    <label> Data da Pesca</label>	
                                </td>
                                <td> 
                                    <label> Peso da Pesca</label>
                                </td>
                            </tr>					
                            @foreach ($tanques as $tanque)
                                @foreach ($tanque->ciclos as $ciclo)
                                    @if($ciclo->pesca != null)    
                                        <tr>
                                            <td><a href="/ciclo/{{$ciclo->id}}/graficos">{{ $tanque->nome }}</a></td>
                                            <td>                                                
                                                {{$ciclo->pesca->data}}
                                            </td>
                                            <td>
                                                {{$ciclo->pesca->peso}}Kg
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
							@endforeach		
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop

