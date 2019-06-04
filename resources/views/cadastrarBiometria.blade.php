@extends('layouts.principal')
@section('title','Cadastrar Biometria')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}"> Tanques </a> > Biometria	
@stop
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                  <div class="menu-direita-logout">
                        Cadastrar Biometria							
                        <img onclick="return confirm('É indicado que a biometria seja realizada com 3% a 10% do lote de 15 em 15 dias. ')" src="{{asset('images/info_white.png')}}" style = "margin-left: 30px; margin-right: -10px " height="25" width="25" align = "right">
                    
                </div>
              </div>
              @if($errors->getMessages() != NULL)
                <div class="alert alert-danger" role="alert">
                  @foreach($errors->getMessages() as &$error) {{$error[0]}} <br/> @endforeach
                </div>
              @endif
              <div class="card-body">
                <form action="/adicionarBiometria" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="id_tanque" value="{{$tanque->id}}" />
                  <div class="form-group">
                    <label>Data</label>
                  <input class="form-control" type="date" name="data" max="{{$data_atual}}" value="{{$data_atual}}" placeholder="DD/MM/AA" autofocus /><br/>
                    <label>Hora</label>
                    <input class="form-control" type="time" step="1" name="hora" value="{{$hora_atual}}" placeholder="HH:MM" autofocus /><br/>
                    <label>Quantidade da amostra (unidade)</label>
                    <input class="form-control" type="text" name="quantidade" autofocus/><br/>
                    <label>Peso total (Kg)</label>
                    <input class="form-control" type="text" step="0.0001" name="peso" autofocus/><br/>
                  </div>
                  <input class="btn btn-success" type="submit" value="Cadastrar" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@stop
