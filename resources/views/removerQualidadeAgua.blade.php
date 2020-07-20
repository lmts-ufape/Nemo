<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
            <title>Remover Especie</title>

    </head>
    <body>
    	<h1>Remover Qualidade da água</h1>

    	<form action="{{route('qualidade.agua.apagar')}}" method="post"> 
    		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    			<input type="hidden" name="id" value="{{ $qualidadeAgua->id}}" />
    			Cod: <input type="text" disabled="disabled" name="id" value="{{$qualidadeAgua->id}}"><br/>
    			Data e hora: <input type="datetime" disabled="disabled" name="data" value="{{$qualidadeAgua->data}}"><br/>
    			PH: <input type="number" disabled="disabled" name="ph" value="{{$qualidadeAgua->ph}}"><br/>
    			<input  type="submit" value="remover!" />
    	</form>

    </body>
</html>
