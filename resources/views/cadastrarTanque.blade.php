@extends('layouts.principal')
@section('title','Cadastrar Tanque')
@section('path')
  <a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}" > Tanques </a> > Cadastrar Tanque
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Cadastrar Tanque
                </div>
                      @if($errors->getMessages() != NULL)
                  <div class="alert alert-danger" role="alert">
                      @foreach($errors->getMessages() as &$error) {{$error[0]}} <br/> @endforeach
                  </div>
                      @endif
                  <form action="/adicionarTanque" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_piscicultura" value="{{$piscicultura->id}}">
                    <div class="card-body">
                      <label>Nome</label>
                    <input class="form-control" type="text" name="nome" placeholder="Nome" value="{{old('nome')}}" autofocus  /><br/>
                      <label>Volume (Litros)</label>
                      <input class="form-control" type="text" min="0" step="any" name="volume"  value="{{old('volume')}}" autofocus /><br/>
                      <label>Área (m²)</label>
                      <input class="form-control" type="text" min="0" step="any" name="area"  /><br/>
                      <label>Altura (m)</label>
                      <input class="form-control" type="text" min="0" step="any" name="altura" /><br/>
                      <input class="btn btn-success" type="submit" value="Cadastrar" />
                    </div>
                  </form>
            </div>
        </div>
    </div>
</div>
@stop
