@extends('layouts.principal')
@section('title','Cadastrar PH')
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
                @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                  @foreach($errors->getMessages() as &$error) {{$error[0]}} @endforeach
                </div>
                @endif
                <form action="/adicionarQualidadeAgua" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="id_tanque" value="{{ $tanque->id}}" />
                  <div class="form-group">
                    <label>PH</label>
                    <input class="form-control" type="number" name="ph" min="0" max="14" value="{{old('ph')}}" autofocus/><br/>
                    <label>Nível de Oxigênio</label>
                    <input class="form-control" type="number" name="nivelOxigenio" value="{{old('nivelOxigenio')}}" autofocus /><br/>
                    <label>Temperatura</label>
                    <input class="form-control" type="text" name="temperatura" value="{{old('temperatura')}}" autofocus /><br/>
                    <label>Nível de Amônia</label>
                    <input class="form-control" type="text" name="nivelAmonia" value="{{old('nivelAmonia')}}" autofocus /><br/>
                    <label>Nitrito</label>
                    <input class="form-control" type="text" name="nitrito" value="{{old('nitrito')}}" autofocus /><br/>
                    <label>Nitrato</label>
                    <input class="form-control" type="text" name="nitrato" value="{{old('nitrato')}}" autofocus /><br/>
                    <label>Alcalinidade</label>
                    <input class="form-control" type="text" name="alcalinidade" value="{{old('alcalinidade')}}" autofocus /><br/>
                    <label>Dureza</label>
                    <input class="form-control" type="text" name="dureza" value="{{old('dureza')}}" autofocus /><br/>
                    <label>Data da Medição</label>
                    <input class="form-control" type="text" name="dataMedicao" value="{{old('dataMedicao')}}" placeholder="DD/MM/AA" autofocus /><br/>
                    <label>Hora da Medição</label>
                    <input class="form-control" type="text" name="horaMedicao" value="{{old('horaMedicao')}}" placeholder="HH:MM" autofocus /><br/>
                  </div>
                  <input class="btn btn-success" type="submit" value="Cadastrar" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@stop
