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
      <input class="form-control" type="number" name="ph" min="0" max="14" required/><br/>
      <label>Nível de Oxigênio</label>
      <input class="form-control" type="number" name="nivelOxigenio" value="{{old('nivelOxigenio')}}" autofocus/><br/>
      <label>Temperatura</label>
      <input class="form-control" type="text" name="temperatura" value="{{old('temperatura')}}" autofocus/><br/>
      <label>Nível de Amônia</label>
      <input class="form-control" type="text" name="nivelAmonia" value="{{old('nivelAmonia')}}" autofocus/><br/>
      <label>Nitrito</label>
      <input class="form-control" type="text" name="nitrito" value="{{old('nitrito')}}" autofocus/><br/>
      <label>Nitrato</label>
      <input class="form-control" type="text" name="nitrato" value="{{old('nitrato')}}" autofocus/><br/>
      <label>Alcalinidade</label>
      <input class="form-control" type="text" name="alcalinidade" value="{{old('alcalinidade')}}" autofocus/><br/>
      <label>Dureza</label>
      <input class="form-control" type="text" name="dureza" value="{{old('dureza')}}" autofocus/><br/>

    </div>
    <input class="btn btn-success" type="submit" value="Cadastrar" />
  </form>
@stop