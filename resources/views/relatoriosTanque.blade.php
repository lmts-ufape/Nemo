<!doctype html> @extends('layouts.principal') @section('title','Relatórios do Tanque') @section('path')
<a href="{{ route("piscicultura.listar") }}">Pisciculturas</a> > <a href="{{ route("piscicultura.informar", ["id" => $piscicultura->id]) }}"> {{$piscicultura->nome}} </a> > <a href="{{ route("tanque.listar", ["id" => $piscicultura->id]) }}"> Tanques </a> > Relatórios do Tanque @stop @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div id="biometria" class="card-header">Informações de Povoamento</div>
                <div class="card-body">
                    <div id="tabela" class="table-responsive">

                        <table class="table">
                            <tr>
                                <th>Data</th>
                                <th>Quantidade</th>
                                <th>Peso total</th>
                                <th>Peso por individuo</th>
                            </tr>
                            <tr>
                            <td>{{ date("d/m/Y", strtotime($povoamento->data)) }}</td>
                            <td>{{ $povoamento->quantidade }}</td>
                            <td>{{ $povoamento->peso }}</td>
                            <td>{{ number_format($povoamento->peso/$povoamento->quantidade, 2, ".", "") }}</td>
                            </tr>	
                        </table>

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
                <div id="qualidade" class="card-header">Relatório da Qualidade da água</div>
                <div class="card-body">
                    <div id="tabela" class="table-responsive">
                        
                        {!! $line_chartPh->html() !!}
                        
                    </div>
                    <hr>
                    <div id="tabela" class="table-responsive">

                        {!! $line_chartTemp->html() !!}

                    </div>
                    <hr>                    
                    <div id="tabela" class="table-responsive">
    
                        {!! $line_chartOxigenio->html() !!}
    
                    </div>
                    <hr>
                    
                    <div id="tabela" class="table-responsive">

                        {!! $line_chartsAmoniaNitritoNitrato->html() !!}

                    </div>
                    <hr>
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