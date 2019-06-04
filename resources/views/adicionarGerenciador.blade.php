@extends('layouts.principal')
@section('title','Adicionar Gerenciador')
@section('path')
  <a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > 
  <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > 
  Adicionar Gerenciador
@stop
@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">
                  Nova Piscicultura
              </div>
              <div class="card-body">
                @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                  @foreach($errors->getMessages() as &$error)
                    {{$error[0]}}
                  @endforeach
                </div>
                @endif
                <form action="/inserirGerenciador" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="is_adiministrador" value=0>
                  <input type="hidden" name="piscicultura_id" value="{{$piscicultura->id}}">
                  <div class="form-group">
                    <label>Endereço de e-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="exemplo@exemplo.com" value="{{old('email')}}" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Adicionar</button>
                </form>
              </div>
          </div>
      </div>
  </div>
</div>
@stop