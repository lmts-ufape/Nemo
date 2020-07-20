<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
            <title>Qualidades de água</title>
    </head>
    <body>
    @foreach ($listaQualidadesAgua as $qualidadeAgua)
    	<b>Cod: {{ $qualidadeAgua->id }}</b> - PH: {{ $qualidadeAgua->ph}}, - Data e hora: {{ $qualidadeAgua->data}}, - Tanque relacionado: {{ $qualidadeAgua->id_tanque}}
      {{-- "/editar/qualidadeAgua/{{$qualidadeAgua->id}}" --}}
		<a href="{{route('qualidade.agua.editar', ['id'=>$qualidadeAgua->id])}}" >Editar</a>
		<a href="{{route('qualidade.agua.remover', ['id'=>$qualidadeAgua->id])}}" >Remover</a>

    	<br/>
    @endforeach
    {{-- "/tanque/{{$id}}/cadastrar/qualidadeAgua" --}}
 		<a href="{{route('qualidade.agua.cadastrar', ['id'=>$id])}}">Novo</a>
    </body>
</html>
