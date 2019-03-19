

@extends('layouts.principal')
@section('title','Listar Pisciculturas')
@section('path')
	Listar Pisciculturas
@stop
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
						<div class="menu-direita-logout">
							Pisciculturas
							<input  style = "margin-left: 15px; margin-right: -10px " height="25" width="25" align = "right" type="submit" value="Nova Piscicultura" class="btn btn-primary" />
						</div>
					
				</div>
				<div class="card-body">
			
					<div>
						<table class="table">
							<tr>
								<th>Nome</th>
							</tr>
							@foreach ($pisciculturas as $piscicultura)
							<tr>
								<td><a href="/info/piscicultura/{{$piscicultura->id}}">{{ $piscicultura->nome }}</a></td>
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