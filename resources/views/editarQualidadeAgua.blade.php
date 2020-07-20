<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
            <title>Editar Qualidade da água</title>

    </head>
    <body>
    	<h1>Editar qualidade da água</h1>

    	<form action="{{ route('qualidade.agua.salvar') }}" method="post"> 
    		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
    			<input type="hidden" name="id" value="{{ $qualidadeAgua->id}}" />
    			PH: <input type="datetime" name="ph"value="{{$qualidadeAgua->ph}}"required="required"><br/>
    			<input  type="submit" value="alterar" />
    	</form>

    </body>
</html>
