@extends('layouts.principal')
@section('title','Cadastrar')
@section('path')
    Cadastrar
@stop
@section('content')
<div class="container" width="50%">
    <div class="card">
        <div class="card-header">
            Cadastro
        </div>
        <div class="card-body">
            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->getMessages() as &$error)
                    {{$error[0]}}<br>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nome</label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}" autofocus/>
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" type="text" name="email" value="{{old('email')}}"" />
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input class="form-control" type="password" name="password" />
                </div>
                <div class="form-group">
                    <label>Confirmar senha</label>
                    <input class="form-control" type="password" name="password_confirmation" />
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
@endsection
