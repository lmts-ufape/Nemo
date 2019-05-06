<!doctype html> @extends('layouts.principal') @section('title','Relatórios do Tanque') @section('path')
<a href="/listar/pisciculturas">Pisciculturas</a> > <a href="/info/piscicultura/{{$piscicultura->id}}"> {{$piscicultura->nome}} </a> > <a href="/listar/tanques/{{$piscicultura->id}}">Tanques</a> > Relatórios do Tanque @stop @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div id="qualidade" class="card-header">Relatório da Qualidade da água</div>
                <div class="card-body">
                    <div id="tabela" class="table-responsive">
                        
                        {!! $line_chartPh->html() !!}
                        
                    </div>

                    <div id="tabela" class="table-responsive">

                        {!! $line_chartTemp->html() !!}

                    </div>

                    <div id="tabela" class="table-responsive">
    
                        {!! $line_chartOxigenio->html() !!}
    
                    </div>
                    
                    <div id="tabela" class="table-responsive">

                        {!! $line_chartsAmoniaNitritoNitrato->html() !!}

                    </div>
                    
                    <div id="tabela" class="table-responsive">

                        {!! $line_chartsDurezaAlcalinidade->html() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>
</div><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div id="biometria" class="card-header">Relatório de Biometria</div>
                <div class="card-body">
                    <div id="tabela" class="table-responsive">

                        {!! $line_chartBiometria->html() !!}

                    </div>
                </div>

            </div>
        </div>
    </div>
</div><br>

{!! Charts::scripts() !!} {!! $line_chartPh->script() !!} {!! $line_chartTemp->script() !!} {!! $line_chartsDurezaAlcalinidade->script() !!} {!! $line_chartOxigenio->script() !!} {!! $line_chartsAmoniaNitritoNitrato->script() !!} {!! $line_chartBiometria->script() !!}  @stop