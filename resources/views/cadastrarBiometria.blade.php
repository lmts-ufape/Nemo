@extends('layouts.principal')
@section('title','Cadastrar Biometria')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Biometria	
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
              <div class="card-body">
                <form action="/adicionarBiometria" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="id_tanque" value="{{$tanque->id}}" />
                  <div class="form-group">
                    <label>Data</label>
                    <input class="form-control" type="date" name="data" value="{{$data_atual}}" placeholder="DD/MM/AA" autofocus /><br/>
                    <label>Hora</label>
                    <input class="form-control" type="time" step="1" name="hora" value="{{$hora_atual}}" placeholder="HH:MM" autofocus /><br/>
                    <label>Quantidade da amostra (unidade)</label>
                    <input class="form-control" type="number" name="quantidade" autofocus/><br/>
                    <label>Peso total (Kg)</label>
                    <input class="form-control" type="number" step="0.0001" name="peso" autofocus/><br/>
                  </div>
                  <input class="btn btn-success" type="submit" value="Cadastrar" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@stop
