

@extends('layouts.principal')
@section('title','Listar Pisciculturas')
@section('path')
	Listar Pisciculturas
@stop
@section('content')
	<div class="row justify-content-center">
		<div class="col-md-8">
			@if (\Session::has('denied'))
                <br>
				<div class="alert alert-warning">
					<strong>Negado!</strong>
					{!! \Session::get('denied') !!}
				</div>
			@endif
			<div class="card" style="width: 100%">
				<div class="card-header">
						<div class="menu-direita-logout">
							Pisciculturas							
							<a href="{{ route("piscicultura.cadastrar") }}">
							
                    			<img src="{{asset('images/add.png')}}" style = "margin-left: 15px; margin-right: -10px " height="25" width="25" align = "right">
							</a>
						</div>
					
				</div>
				<div class="card-body">			
					<div>
						<table class="table">
							@foreach ($pisciculturas as $piscicultura)
							<tr>
								<td><a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}}
									<a onclick="return confirm('Confirmar remoção de {{ $piscicultura->nome}}?')" href="{{ route("piscicultura.remover", ["id" => $piscicultura->id]) }}">
										<img src="{{asset('images/delete.png')}}" style = "margin-left: 30px; margin-right: -10px " height="25" width="25" align = "right">
									</a>
									<a href="{{ route("piscicultura.editar", ["id" => $piscicultura->id]) }}">
										<img src="{{asset('images/edit-black.png')}}"  style = "margin-left: 15px; margin-right: -10px " height="25" width="25" align = "right">
									</a>
								</td>
							
							</tr>
							
							@endforeach		
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop