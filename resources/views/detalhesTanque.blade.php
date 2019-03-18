<!doctype html>
@extends('layouts.principal')
@section('title','Detalhe dos Tanques')
@section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Detalhes do Tanque
@stop
@section('content')
	<div>
		<table class="table">
			<tr>
                <th>Nome</th>
                <th>Volume</th>
                <th>Área</th>
                <th>Altura</th>
			</tr>
			<tr>
			<td>{{ $tanque->nome }}</td>
            <td>{{ $tanque->volume }}</td>
            <td>{{ $tanque->area }}</td>
            <td>{{ $tanque->altura }}</td>
			</tr>	
		</table>
    </div>
    <div align = "center">
        <a  class="btn btn-warning" href="/editar/tanque/{{$tanque->id}}">Editar</a>
        <a class="btn btn-danger" href="/remover/tanque/{{$tanque->id}}">Remover</a>
    </div>	
@stop