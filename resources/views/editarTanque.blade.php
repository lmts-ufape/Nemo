@extends('layouts.principal')
@section('title','Editar Tanque')
@section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}"> Tanques </a> > Editar Tanque
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Tanque
                </div>
                @if($errors->getMessages() != NULL)
                  <div class="alert alert-danger" role="alert">
                        @foreach($errors->getMessages() as &$error) {{$error[0]}} <br/> @endforeach
                  </div>
                @endif
                    <form action="/salvarTanque" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" min="0" value="{{ $tanque->id}}" />
                      <div class="card-body">
                          <label>Nome</label>
                          <input class="form-control" step="any" type="text" name="nome"value="{{$tanque->nome}}"/><br/>
                          <label>Volume</label>
                          <input class="form-control" type="text" step="any" name="volume" value="{{$tanque->volume}}" /><br/>
                          <label>Área</label>
                          <input class="form-control" type="text" step="any" name="area" value="{{$tanque->area}}" /><br/>
                          <label>Altura</label>
                          <input class="form-control" type="text" step="any" name="altura" value="{{$tanque->altura}}" /><br/>
                          
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