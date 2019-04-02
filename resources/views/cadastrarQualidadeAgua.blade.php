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
                  <a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/ph">PH</a>
                  <a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/amonia">Amonia</a>
                  <a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/nitrito">Nitrito</a>
                  <a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/nitrato">Nitrato</a>
                  <a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/oxigenio">Oxigênio</a>
                  <a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/temperatura">Temperatura</a>
                  <a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/dureza">Dureza</a>
                  <a class="btn btn-primary" href="/tanque/{{$tanque->id}}/cadastrar/alcalinidade">Alcalinidade</a>
              
              </div>
            </div>
          </div>
        </div>
      </div>

@stop
