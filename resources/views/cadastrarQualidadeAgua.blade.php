

@extends('layouts.principal')
@section('title','Cadastrar Qualidade da água')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}"> Tanques </a> > Parâmetros da água
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
                  <form action="{{ route('qualidade.agua.adicionar') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id_tanque" value="{{$tanque->id}}" />

                    <div class="form-group">
                      <label>Data da Medição</label>
                      <input class="form-control" type="date" name="data" value="{{$data_atual}}" max="{{$data_atual}}"  placeholder="DD/MM/AA" /><br/>
                      <label>Hora da Medição</label>
                      <input class="form-control" type="time" step="1" name="hora" value="{{$hora_atual}}" placeholder="HH:MM" /><br/>
                      <input type="checkbox" name="phBox" id="phBox" onchange="teste(this)" />
                      <label>Ph</label>
                      <img onclick="return confirm('É recomendado que o valor do PH esteja entre 6,5 e 8,5')" src="{{asset('images/info.png')}}"  height="18" width="18">
                      <input id="ph" class="form-control" type="number" name="ph" min="0" max="14" disabled/><br/>
                      <input type="checkbox" name="temperaturaBox" id="temperaturaBox" onchange="teste(this)" />
                      <label>Temperatura (°C)</label>
                      <img onclick="return confirm('A temperatura ideal é entre 26°C a 30°C')" src="{{asset('images/info.png')}}"  height="18" width="18">
                      <input id="temperatura" class="form-control" type="number" name="temperatura"  value="{{old('temperatura')}}" disabled/><br/>
                      <input type="checkbox" name="oxigenioBox" id="oxigenioBox" onchange="teste(this)" />
                      <label>Nível de Oxigênio (mg/L)</label>
                      <img onclick="return confirm('É recomendado que o nível de oxigênio seja maior ou igual a 3mg/l')" src="{{asset('images/info.png')}}"  height="18" width="18">
                      <input id="oxigenio" class="form-control" step="0.01" type="number" name="oxigenio"  value="{{old('oxigenio')}}" disabled/><br/>
                      <input type="checkbox" name="amoniaNitritoNitratoBox" id="amoniaNitritoNitratoBox" onchange="teste(this)" />
                      <label>Amônia, Nitrito e Nitrato</label><br>
                      <div class="card-body">
                        <label>Amônia (mg/L)</label>
                        <img onclick="return confirm('É recomendado que o valor do Amônia esteja entre 0 e 0,5mg/L')" src="{{asset('images/info.png')}}"  height="18" width="18">
                        <input id="amonia" class="form-control" step="0.01" type="number" name="amonia"  value="{{old('amonia')}}" disabled/><br/>
                        <label>Nitrito (mg/L)</label>
                        <img onclick="return confirm('É recomendado que o valor do Nitrito esteja entre 0 e 0,5mg/L')" src="{{asset('images/info.png')}}"  height="18" width="18">
                        <input id="nitrito" class="form-control"  type="number" step="0.01" name="nitrito"  value="{{old('nitrito')}}" disabled/><br/>
                        <label>Nitrato (mg/L)</label>
                        <img onclick="return confirm('É recomendado que o valor do Nitrato esteja entre 0 e 0,5mg/L')" src="{{asset('images/info.png')}}"  height="18" width="18">
                        <input id="nitrato" class="form-control" type="number" step="0.01" name="nitrato"  value="{{old('nitrato')}}" disabled/><br/>
                      </div>
                      <input type="checkbox" name="alcalinidadeDurezaBox" id="alcalinidadeDurezaBox" onchange="teste(this)" />
                      <label>Alcalinidade e Dureza</label><br>
                      <div class="card-body">
                        <label>Alcalinidade (mg CaCO3/L)</label>
                        <img onclick="return confirm('É recomendado que o nível de Alcalinidade seja maior ou igual a 30mg CaCO3/L')" src="{{asset('images/info.png')}}"  height="18" width="18">
                        <input id="alcalinidade" class="form-control" step="0.01" type="number" name="alcalinidade"  value="{{old('alcalinidade')}}" disabled/><br/>
                        <label>Dureza (mg CaCO3/L)</label>
                        <img onclick="return confirm('É recomendado que o nível de Dureza seja maior ou igual a 30mg CaCO3/L')" src="{{asset('images/info.png')}}"  height="18" width="18">
                        <input id="dureza" class="form-control" type="number" step="0.01" name="dureza"  value="{{old('dureza')}}" disabled/><br/>
                      </div>
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
    if(qualidade == "amoniaNitritoNitrato"){
      var input1 = document.getElementById('amonia');
      var input2 = document.getElementById('nitrito');
      var input3 = document.getElementById('nitrato');
      if(checkbox.checked){
        input1.disabled = false
        input2.disabled = false
        input3.disabled = false
      }else{
        input1.disabled = true;
        input1.value = '';
        input2.disabled = true;
        input2.value = '';
        input3.disabled = true;
        input3.value = '';
      }
    }else if(qualidade == "alcalinidadeDureza"){
      var input1 = document.getElementById('alcalinidade');
      var input2 = document.getElementById('dureza');
      if(checkbox.checked){
        input1.disabled = false
        input2.disabled = false
      }else{
        input1.disabled = true;
        input1.value = '';
        input2.disabled = true;
        input2.value = '';
      }
    }else{
      var input = document.getElementById(qualidade);
      if(checkbox.checked){
        input.disabled = false
      }else{
        input.disabled = true;
        input.value = '';
      }
    }
  }
  </script>

@stop
