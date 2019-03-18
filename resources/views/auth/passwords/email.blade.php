@extends('layouts.principal')
@section('title','Esqueci minha senha')
@section('path')
    Esqueci minha senha
@stop
@section('content')
<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        E-mail para redefinição de senha enviado!
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            Esqueci minha senha
        </div>
        <div class="card-body">
            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>E-mail</label>
                    <input class="form-control" type="email" name="email" autofocus />
                </div>

                <button type="submit" class="btn btn-primary">Enviar link para restaurar senha</button>
            </form>
        </div>
    </div>
</div>

@endsection
