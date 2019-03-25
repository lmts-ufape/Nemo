@extends('layouts.principal')
@section('title','Editar Tanque')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Editar Tanque
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Tanque
                </div>
                    <form action="/salvarTanque" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" min="0" value="{{ $tanque->id}}" />
                      <div class="card-body">
                          <label>Nome</label>
                          <input class="form-control" step="any" type="text" name="nome"value="{{$tanque->nome}}"required="required"/><br/>
                          <label>Volume</label>
                          <input class="form-control" type="number" step="any" name="volume" value="{{$tanque->volume}}" required/><br/>
                          <label>Área</label>
                          <input class="form-control" type="number" step="any" name="area" value="{{$tanque->area}}" required/><br/>
                          <label>Altura</label>
                          <input class="form-control" type="number" step="any" name="altura" value="{{$tanque->altura}}" required/><br/>
                          <label>Formato</label>
                          <input class="form-control" step="any" type="text" name="formato"value="{{$tanque->formato}}"required="required"/><br/>
                      </div>
                      <div class="card-body">            
                        <input class="btn btn-primary" type="submit" value="Salvar" />
                      </div>
                      
                    </form>
                    
                    </div>
                    </div>
                    </div>
                    </div>
                    @stop
