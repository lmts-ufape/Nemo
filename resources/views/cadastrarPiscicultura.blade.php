@extends('layouts.principal') @section('title','Criar Piscicultura') @section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > Criar Piscicultura @endsection @section('content')
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
                        @foreach($errors->getMessages() as &$error) {{$error[0]}} @endforeach
                    </div>
                    @endif
                    <form form action="/adicionarPiscicultura" method="POST">
                        @csrf
                        <div class="form-group">
                            <label> Nome</label>
                            <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{old('nome')}}" autofocus />
                        </div>
                        <button type="submit" class="btn btn-primary">Criar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection