@extends('layouts.principal')
@section('title','Cadastrar PH')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Parâmetros da água	
@stop
@section('content')
  <form action="/adicionarQualidadeAgua" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="id_tanque" value="{{ $tanque->id}}" />
    <div class="form-group">
      <label>PH</label>
      <input class="form-control" type="number" name="ph" min="0" max="14" required autofocus/><br/>
      <label>Nível de Oxigênio</label>
      <input class="form-control" type="number" name="nivelOxigenio" value="{{old('nivelOxigenio')}}" /><br/>
      <label>Temperatura</label>
      <input class="form-control" type="number" name="temperatura" value="{{old('temperatura')}}" /><br/>
      <label>Nível de Amônia</label>
      <input class="form-control" type="number" name="nivelAmonia" value="{{old('nivelAmonia')}}" /><br/>
      <label>Nitrito</label>
      <input class="form-control" type="number" name="nitrito" value="{{old('nitrito')}}" /><br/>
      <label>Nitrato</label>
      <input class="form-control" type="number" name="nitrato" value="{{old('nitrato')}}" /><br/>
      <label>Alcalinidade</label>
      <input class="form-control" type="number" name="alcalinidade" value="{{old('alcalinidade')}}" /><br/>
      <label>Dureza</label>
      <input class="form-control" type="number" name="dureza" value="{{old('dureza')}}" /><br/>
      <label>Data da Medição</label>
      <input class="form-control" type="text" name="dataMedicao" placeholder="DD/MM/AA - HH:MM" value="{{old('dataMedicao')}}" /><br/>

    </div>
    <input class="btn btn-success" type="submit" value="Cadastrar" />
  </form>
@stop