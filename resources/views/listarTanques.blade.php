<!doctype html>
@extends('layouts.principal')
@section('title','Listar Tanques')
@section('path')
	<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > Listagem de tanques
@stop
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
						<div class="menu-direita-logout">
							Tanques
							<a href="{{ route("tanque.cadastrar", ["id" => $piscicultura->id]) }}">					
                    			<img src="{{asset('images/add.png')}}" style = "margin-left: 15px; margin-right: -10px " height="25" width="25" align="right">
							</a>
						</div>
					
				</div>
				<div class="card-body">
					<div>
						<table class="table">							
							@foreach ($tanques as $tanque)
							<tr>
									
							<td><a href="{{ route("tanque.detalhar", ["id" => $tanque->id]) }}">{{ $tanque->nome }}</a></td>
								<td>
									@if($tanque->status != "manutencao")
										@if($tanque->status == "livre")
											<a class="btn btn-primary" href="{{ route("especies.listar", ["id" => $tanque->id]) }}">Povoar</a>
										@endif
										<a class="btn btn-primary" href="{{ route("qualidade.agua.cadastrar", ["id" => $tanque->id]) }}">Qualidade da água</a>
										@if($tanque->ciclos[count($tanque->ciclos)-1]->povoamento != null)
											<a class="btn btn-primary" href="{{ route("biometria.cadastrar", ["id" => $tanque->id]) }}">Biometria</a>
											<a class="btn btn-primary" href="{{ route("tanque.gerar.relatorios", ["id" => $tanque->id]) }}">Relatorios</a>
											@if(count($tanque->ciclos[count($tanque->ciclos)-1]->qualidade_agua->temperaturas) !=0 && count($tanque->ciclos[count($tanque->ciclos)-1]->biometrias) != 0 )
												<a class="btn btn-primary" href="{{ route("tanque.racao", ["id" => $tanque->id]) }}">Ração</a>
											@endif
											@if($tanque->status == 'producao')
												<a class="btn btn-primary" href="{{ route("pesca.pesca", ["id" => $tanque->id]) }}">Pescar</a>
											@endif
										@endif
									@else
										<a class="btn btn-primary" href="{{ route("tanque.manutencao", ["id" => $tanque->id]) }}">Finalizar manutenção</a>
									@endif
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

