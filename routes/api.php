<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//ROTAS AUTENTICADAS
Route::middleware(['auth:api'])->namespace('Api')->name('api.')->group(function () {
    Route::prefix('tecnico')->group(function () {
        //RECUPERAR TÉCNICO LOGADO
        Route::get('/logged_tecnico', 'TecnicoController@userLogged')->name('logged_tecnico');
    });
});

//ROTAS QUE NÃO NECESSITAM DE AUTENTICAÇÃO
Route::namespace('Api')->name('api.')->group(function () {
    Route::prefix('tecnico')->group(function () {
        //CADASTRAR TÉCNICO
        Route::post('/novo_tecnico', 'TecnicoController@store')->name('novo_tecnico');
    });
    Route::prefix('evento')->group(function () {
        //RETORNA TODOS OS EVENTOS APÓS A DATA INFORMADA
        Route::post('/carregar_agenda', 'evento_agenda_controller@carregar_agenda')->name('carregar_agenda');
        //LISTA OS TIPOS DE FORMULARIOS
        Route::get('/listar_formularios', 'evento_agenda_controller@listar_formularios')->name('listar_formularios');        
        //LISTAR OS EVENTOS POR TIPO DE FORMULARIO
        Route::post('/listar_eventos', 'evento_agenda_controller@listar_eventos')->name('listar_eventos');
        //Retorna um evento completo para exibição
        Route::post('/exibir_evento', 'evento_agenda_controller@exibir_evento')->name('exibir_evento');
    });
    Route::prefix('cooperado')->group(function () {
        //RETORNA TODOS OS EVENTOS APÓS A DATA INFORMADA
        Route::post('/relatorio_qualidade', 'cooperado_controller@relatorio_qualidade')->name('relatorio_qualidade');
    });
});
