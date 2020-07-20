@extends('layouts.principal')
@section('title','Escalonamento de Produção')
@section('path')
	<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > Escalonamento de Produção
@stop
@section('content')
	<div class='container'>
		<div class="row justify-content-center">
        	<div class="col-md-8">
				@if (\Session::has('Fail'))
                	<br>
					<div class="alert alert-danger">
						<strong>Erro!</strong>
						{!! \Session::get('Fail') !!}
					</div>
				@endif
            	<div class="card">
                	<div class="card-header">
                    	Escalonamento da Produção
					</div>
					@if (isset($errors) && count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						@foreach($errors->getMessages() as &$error)
							{{$error[0]}}
							<br>
						@endforeach
					</div>
					@endif
					<form action="{{route('escalonamento.resultado')}}" method="post">
						@csrf
						<input type="hidden" value="{{$piscicultura->id}}" name="piscicultura_id">
						<div class="card-body">
							<div class="form-group">
								<label>peso médio para despesca (Em gramas)</label>
								<input class="form-control" type="text" name="pesoMedio" placeholder="Em gramas" value="{{old('pesoMedio')}}" autofocus/>
							</div>
							<div class="form-group">
								<label>Duração do ciclo (Em meses)</label>
								<input class="form-control" type="text" name="duracaoCiclo" placeholder="Em meses" value="{{old('duracaoCiclo')}}">
							</div>
							<div class="form-group">
								<label>Periodicidade da despesca</label>
								<select class="custom-select" name="periodicidade">
									<option selected>Selecione a periodicidade</option>
									<option value="7">Semanal</option>
									<option value="14">Quinzenal</option>
									<option value="28">Mensal</option>
								</select>
							</div>
							{{-- <div class="form-group">
									<label>Espécie</label>
									<select class="custom-select" name="especie">
										<option selected>Selecione a espécie</option>
										@foreach ($especiePeixe as $especie)
											<option value="{{$especie->id}}">{{$especie->nome}}</option>
										@endforeach
									</select>
								</div> --}}
							<div class="form-group">
								<label>Produção Desejada (Em Kg)</label>
								<input class="form-control" type="text" name="producaoDesejada" placeholder="Em Kg" value="{{old('producaoDesejada')}}">
							</div>
							<div class="form-group">
								<label>Data do inicio da Produção</label>
								<input class="form-control" type="date" name="inicioProducao" placeholder="DD/MM/AA" value="{{old('inicioProducao')}}">
							</div>
							<input class="btn btn-primary" type="submit" value="Calcular"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@stop
