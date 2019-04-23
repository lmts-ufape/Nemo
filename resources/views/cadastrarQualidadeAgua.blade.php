

@extends('layouts.principal')
@section('title','Cadastrar Qualidade da água')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Parâmetros da água	
@stop
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                  Cadastrar qualidade da água
              </div>
              <div class="card-body">
                  <form action="/adicionarQualidadeAgua" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id_tanque" value="{{$tanque->id}}" />
                    
                    <div class="form-group">
                      <label>Data da Medição</label>
                      <input class="form-control" type="date" name="data" value="{{old('data')}}" placeholder="DD/MM/AA" /><br/>
                      <label>Hora da Medição</label>
                      <input class="form-control" type="time" name="hora" value="{{old('hora')}}" placeholder="HH:MM" /><br/>
                      <input type="checkbox" name="phBox" id="phBox" onchange="teste(this)" />
                      <label>PH</label>
                      <input id="ph" class="form-control" type="number" name="ph" min="0" max="14" disabled/><br/>
                      <input type="checkbox" name="temperaturaBox" id="temperaturaBox" onchange="teste(this)" />
                      <label>Temperatura</label>
                      <input id="temperatura" class="form-control" type="number" name="temperatura"  value="{{old('temperatura')}}" disabled/><br/>
                      <input type="checkbox" name="oxigenioBox" id="oxigenioBox" onchange="teste(this)" />
                      <label>Nível de Oxigênio</label>
                      <input id="oxigenio" class="form-control" type="number" name="oxigenio"  value="{{old('oxigenio')}}" disabled/><br/>
                      <input type="checkbox" name="amoniaBox" id="amoniaBox" onchange="teste(this)" />
                      <label>Amônia</label>
                      <input id="amonia" class="form-control" type="number" name="amonia"  value="{{old('amonia')}}" disabled/><br/>
                      <input type="checkbox" name="nitrato" id="nitratoBox" onchange="teste(this)" />
                      <label>Nitrato</label>
                      <input id="nitrato" class="form-control" type="number" name="nitrato"  value="{{old('ph')}}" disabled/><br/>
                      <input type="checkbox" name="nitritoBox" id="nitritoBox" onchange="teste(this)" />
                      <label>Nitrito</label>
                      <input id="nitrito" class="form-control" type="number" name="nitrito"  value="{{old('ph')}}" disabled/><br/>
                      <input type="checkbox" name="durezaBox" id="durezaBox" onchange="teste(this)" />
                      <label>Dureza</label>
                      <input id="dureza" class="form-control" type="number" name="dureza"  value="{{old('ph')}}" disabled/><br/>
                      <input type="checkbox" name="alcalinidadeBox" id="alcalinidadeBox" onchange="teste(this)" />
                      <label>Alcalinidade</label>
                      <input id="alcalinidade" class="form-control" type="number" name="alcalinidade"  value="{{old('ph')}}" disabled/><br/>
                    </div>
                    <input class="btn btn-success" type="submit" value="Cadastrar" />
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
<script type="text/javascript">
  teste = function habilitar(checkbox){
    var qualidade = (checkbox.id).replace('Box','');
    var input = document.getElementById(qualidade);
    if(checkbox.checked){
      input.disabled = false  
    }else{
      input.disabled = true;
      input.value = '';
    }
  }
  </script>
@stop