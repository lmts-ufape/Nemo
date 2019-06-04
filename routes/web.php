<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//Rotas de Autenticação
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('autorizacao')->group(function() {
    //Rotas de Piscicultura
    Route::get('/listar/pisciculturas', "PisciculturaController@listar")->name('piscicultura.listar');
    Route::get('/info/piscicultura/{id}',"PisciculturaController@informar")->name('piscicultura.informar');
    Route::get('/cadastrar/piscicultura', "PisciculturaController@cadastrar")->name('piscicultura.cadastrar');
    Route::post('/adicionarPiscicultura', "PisciculturaController@adicionar")->name('piscicultura.adicionar');
    Route::get('/editar/pisciculturas/{id}', "PisciculturaController@editar")->name('piscicultura.editar');
    Route::post('/salvarPiscicultura', "PisciculturaController@salvar")->name('piscicultura.salvar');
    Route::get('/remover/piscicultura/{id}', "PisciculturaController@remover")->name('piscicultura.remover');
    Route::get('/relatorios/pescas/{id}', "PisciculturaController@relatoriosPesca")->name('piscicultura.pesca.relatorios');
    Route::get('/ciclo/{id}/graficos', "PisciculturaController@graficosPesca")->name('piscicultura.pesca.graficos');
    
    //Rotas de Gerenciador
    Route::get('listar/gerenciadores/piscicultura/{id}',"GerenciarController@listarGerenciadores")->name('gerenciador.listar');
    Route::get('adicionar/gerenciador/piscicultura/{id}',"GerenciarController@adicionarGerenciador")->name('gerenciador.adicionar');
    Route::post('inserirGerenciador',"GerenciarController@inserirGerenciador")->name('gerenciador.inserir');
    Route::get('/remover/gerenciador/{user_id}/piscicultura/{id}',  "GerenciarController@apagarGerenciador")->name('gerenciador.apagar');
    

    //Rotas de Tanque
    Route::get('/listar/tanques/{id}', "TanqueController@listar")->name('tanque.listar');
    Route::get('/cadastrar/tanque/{id}', "TanqueController@cadastrar")->name('tanque.cadastrar');
    Route::post('/adicionarTanque', "TanqueController@adicionar")->name('tanque.adicionar');
    Route::get('/editar/tanque/{id}', "TanqueController@editar")->name('tanque.editar');
    Route::post('/salvarTanque', "TanqueController@salvar")->name('tanque.salvar');
    Route::get('/remover/tanque/{id}', "TanqueController@remover")->name('tanque.remover');
    Route::post('/apagarTanque', "TanqueController@apagar")->name('tanque.apagar');
    Route::get('/tanque/{id}/detalhes', "TanqueController@exibirDetalhes")->name('tanque.detalhar');
    Route::get('/relatorios/tanque/{id}', "TanqueController@gerarRelatorios")->name('tanque.gerar.relatorios');
    Route::get('/tanque/{id}/racao', "TanqueController@tabelaRacao")->name('tanque.racao');
    Route::get('/tanque/{id}/manutencao', "TanqueController@manutencao")->name('tanque.manutencaogit ');

    //Rotas de Espécie
    Route::get('/listar/especies/{id}', "EspecieController@listar")->name('especies.listar');
    //Route::get('/adicionar/especie/{id}', "EspecieController@adicionar")->name('especie.adicionar');
    //Route::post('/cadastrarEspecie', "EspecieController@cadastrar")->name('especie.cadastrar');
    //Route::post('/salvarEspecie', "EspecieController@salvar")->name('especie.salvar');
    //Route::get('/editar/tanque/{id}/especie/{especiePeixe_id}', "EspecieController@editar")->name('especie.editar');;
    //Route::post('/apagarEspecie', "EspecieController@apagar")->name('especie.apagar');;
    //Route::get('/remover/tanque/{id}/especie/{especiePeixe_id}', "EspecieController@remover")->name('especie.remover');;
    //Route::get('/tanque/{id}/especie/{especiePeixe_id}/info', "EspecieController@informar")->name('especie.informar');;


    
    //Rotas de Sistema
    Route::get('/', 'PisciculturaController@listar')->name('home');
    Route::get('/home', 'PisciculturaController@listar')->name('home');
    
    //Rotas de Qualidade Água
    Route::get('/tanque/{id}/cadastrar/qualidadeAgua', "QualidadeAguaController@cadastrar")->name('qualidade.agua.cadastrar');
    Route::post('/adicionarQualidadeAgua', "QualidadeAguaController@adicionar")->name('qualidade.agua.adicionar');
    Route::get('/tanque/{id}/listar/qualidadesAgua', "QualidadeAguaController@listar")->name('qualidade.agua.listar');
    Route::get('/editar/qualidadeAgua/{id}', "QualidadeAguaController@editar")->name('qualidade.agua.editar');
    Route::post('/salvarQualidadeAgua', "QualidadeAguaController@salvar")->name('qualidade.agua.salvar');
    Route::post('/apagarQualidadeAgua', "QualidadeAguaController@apagar")->name('qualidade.agua.apagar');
    Route::get('/remover/qualidadeAgua/{id}', "QualidadeAguaController@remover")->name('qualidade.agua.remover');
    //Route::get('/tanque/{id}/cadastrar/ph', "PhController@cadastrar")->name('ph.cadastrar');
    //Route::post('/adicionarPh', "PhController@adicionar")->name('ph.adicionar');
    //Route::get('/tanque/{id}/cadastrar/amonia', "AmoniaController@cadastrar")->name('amonia.cadastrar');
    //Route::post('/adicionarAmonia', "AmoniaController@adicionar")->name('amonia.adicionar');
    //Route::get('/tanque/{id}/cadastrar/nitrito', "NitritoController@cadastrar")->name('nitrito.cadastrar');
    //Route::post('/adicionarNitrito', "NitritoController@adicionar")->name('nitrito.adicionar');
    //Route::get('/tanque/{id}/cadastrar/nitrato', "NitratoController@cadastrar")->name('nitrato.cadastrar');
    //Route::post('/adicionarNitrato', "NitratoController@adicionar")->name('nitrato.adicionar');
    //Route::get('/tanque/{id}/cadastrar/oxigenio', "OxigenioController@cadastrar")->name('oxigenio.cadastrar');
    //Route::post('/adicionarOxigenio', "OxigenioController@adicionar")->name('oxigenio.adicionar');
    //Route::get('/tanque/{id}/cadastrar/dureza', "DurezaController@cadastrar")->name('dureza.cadastrar');
    //Route::post('/adicionarDureza', "DurezaController@adicionar")->name('dureza.adicionar');
    //Route::get('/tanque/{id}/cadastrar/alcalinidade', "AlcalinidadeController@cadastrar")->name('alcalinidade.cadastrar');
    //Route::post('/adicionarAlcalinidade', "AlcalinidadeController@adicionar")->name('alcalinidade.adicionar');
    //Route::get('/tanque/{id}/cadastrar/temperatura', "TemperaturaController@cadastrar")->name('temperatura.cadastrar');
    //Route::post('/adicionarTemperatura', "TemperaturaController@adicionar")->name('temperatura.adicionar');
    
    //Rotas de Povoamento (falta middleware)
    Route::get('/povoar/tanque/{id}/especie/{especie_id}',  "PovoamentoController@povoarTanque")->name('povoamento.povoar');
    Route::post('/inserirPeixe', "PovoamentoController@inserirPeixe")->name('povoamento.inserir.peixe')->name('povoamento.inserir.peixe');
    //Route::get('/info/tanque/{id}', "PovoamentoController@listar")->name('povoamento.listar');
    
    //Rotas de Pesca
    Route::get('/tanque/{id}/pesca', "PescaController@pesca")->name('pesca.pesca');
    Route::post('/pescar', "PescaController@pescar")->name('pescar.pescar');
    
    //Rotas de Biometria
    Route::get('/tanque/{id}/cadastrar/biometria', "BiometriaController@cadastrar")->name('biometria.cadastrar');
    Route::post('/adicionarBiometria', "BiometriaController@adicionar")->name('biometria.adicionar');
    

    //Rotas de Escalonamento
    Route::get('/escalonamento/{id}', "EscalonamentoController@chamaEscalonamento")->name('escalonamento.chamar');
    Route::post('/resultadoEscalonamento', "EscalonamentoController@calcularEscalonamento")->name('escalonamento.resultado');
});