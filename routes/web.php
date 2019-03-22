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

//Rotas de Piscicultura
Route::get('/listar/pisciculturas', "PisciculturaController@listar");
Route::get('/info/piscicultura/{id}',"PisciculturaController@informar");
Route::get('/cadastrar/piscicultura', "PisciculturaController@cadastrar");
Route::post('/adicionarPiscicultura', "PisciculturaController@adicionar");
Route::get('/editar/pisciculturas/{id}', "PisciculturaController@editar");
Route::post('/salvarPiscicultura', "PisciculturaController@salvar");
Route::get('/remover/piscicultura/{id}', "PisciculturaController@remover");
Route::post('/apagarPiscicultura', "PisciculturaController@apagar");

//Rotas de Gerenciador
Route::get('listar/gerenciadores/piscicultura/{id}',"GerenciarController@listarGerenciadores")->name('listar.gerenciadores');
Route::get('adicionar/gerenciador/piscicultura/{id}',"GerenciarController@adicionarGerenciador");
Route::post('inserirGerenciador',"GerenciarController@inserirGerenciador");
Route::get('/remover/gerenciador/{user_id}/piscicultura/{piscicultura_id}',  "GerenciarController@apagarGerenciador");

//Rotas de Tanque
Route::get('/listar/tanques/{id}', "TanqueController@listar")->name('listarTanques');
Route::get('/cadastrar/tanque/{id}', "TanqueController@cadastrar");
Route::post('/adicionarTanque', "TanqueController@adicionar");
Route::get('/editar/tanque/{id}', "TanqueController@editar");
Route::post('/salvarTanque', "TanqueController@salvar");
Route::get('/remover/tanque/{id}', "TanqueController@remover");
Route::post('/apagarTanque', "TanqueController@apagar");
Route::get('/tanque/{id}/detalhes', "TanqueController@exibirDetalhes")->name('detalhesTanque');
Route::get('/relatorios/tanque/{id}', "TanqueController@gerarRelatorios");

//Rotas de Espécie
Route::get('/listar/especies/{id}', "EspecieController@listar")->name('listarEspecies');
Route::get('/adicionar/especie/{id}', "EspecieController@adicionar");
Route::post('/cadastrarEspecie', "EspecieController@cadastrar");
Route::post('/salvarEspecie', "EspecieController@salvar");
Route::get('/editar/tanque/{id}/especie/{especiePeixe_id}', "EspecieController@editar");
Route::post('/apagarEspecie', "EspecieController@apagar");
Route::get('/remover/tanque/{id}/especie/{especiePeixe_id}', "EspecieController@remover");
Route::get('/tanque/{id}/especie/{especiePeixe_id}/info', "EspecieController@informar");


//Rotas de Autenticação
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

//Rotas de Sistema
Route::get('/', 'PisciculturaController@listar')->name('home');
Route::get('/home', 'PisciculturaController@listar')->name('home');

//Rotas de Qualidade Água
Route::get('/tanque/{id}/cadastrar/qualidadeAgua', "QualidadeAguaController@cadastrar");
Route::post('/adicionarQualidadeAgua', "QualidadeAguaController@adicionar");
Route::get('/tanque/{id}/listar/qualidadesAgua', "QualidadeAguaController@listar")->name('listarQualidades');
Route::get('/editar/qualidadeAgua/{id}', "QualidadeAguaController@editar");
Route::post('/salvarQualidadeAgua', "QualidadeAguaController@salvar");
Route::post('/apagarQualidadeAgua', "QualidadeAguaController@apagar");
Route::get('/remover/qualidadeAgua/{id}', "QualidadeAguaController@remover");

//Rotas de Povoamento
Route::get('/povoar/tanque/{tanque_id}/especie/{especie_id}',  "PovoamentoController@povoarTanque");
Route::post('/inserirPeixe', "PovoamentoController@inserirPeixe");
Route::get('/info/tanque/{id}', "PovoamentoController@listar")->name('infoTanque');

//Rotas de Pesca
Route::get('/tanque/{tanque_id}/pesca/especie/{especiePeixe_id}/povoamento/{povoamento_id}', "PescaController@pesca");
Route::post('/pescarEspecie', "PescaController@pescar");

//Rotas de Escalonamento
Route::get('/escalonamento/{id}', "EscalonamentoController@chamaEscalonamento");
Route::post('/calcularEscalonamento', "EscalonamentoController@calcularEscalonamento");


