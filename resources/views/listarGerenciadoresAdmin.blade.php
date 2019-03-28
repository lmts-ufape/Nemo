@extends('layouts.principal')
@section('title','Gerenciadores')
@section('path')
	<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > Gerenciadores
	
@stop
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Gerenciador
				</div>
				<div class="card-body">
					<ul>
						<div class="card-header">
							Administrador
						</div>
						<table class="table">
								<tr>
									<td>{{ $admin->name }}</td>					
								</tr>
							</table>
							<div class="card-header">
								Gerenciador
							</div>
							<table class="table">
								@foreach ($gerenciadores as $gerenciador)
								<tr>
									<td>{{ $gerenciador->name }}</td>
									<td><a class="btn btn-danger"  href="/remover/gerenciador/{{$gerenciador->id}}/piscicultura/{{$piscicultura_id}}">Remover</td>
								</tr>
								@endforeach
							</table>
						
						
						<br>
						<br>
						<a class="btn btn-primary" href="/adicionar/gerenciador/piscicultura/{{$piscicultura_id}}">Adicionar novo gerenciador</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>	
@stop

