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
//middleware(['auth:api'])->
Route::middleware(['auth:api'])->namespace('Api')->name('api.')->group(function () {
    Route::prefix('tecnico')->group(function () {
        //CADASTRAR TÉCNICO
        Route::post('/novo_tecnico', 'TecnicoController@store')->name('novo_tecnico');
        //RECUPERAR TÉCNICO LOGADO
        Route::get('/logged_tecnico', 'TecnicoController@userLogged')->name('logged_tecnico');
    });
    Route::prefix('tecnico')->group(function () {
        //LISTAR TÉCNICOS
        Route::get('/tecnicos_all', 'TecnicoController@tecnicos_all')->name('tecnicos_all');  
    });
    Route::prefix('qualidade')->group(function () {
        //LISTAR ULTIMAS
        Route::get('/ultimas_qualidades', 'QualidadeController@ultimas_qualidades')->name('ultimas_qualidades');
    });
    Route::prefix('tanque')->group(function () {
        //LISTAR TANQUES
        Route::get('/tanques_all', 'tanque_controller@tanques_all')->name('tanques_all');  
    });
    Route::prefix('evento')->group(function () {
        //RETORNA TODOS OS EVENTOS APÓS A DATA INFORMADA
        Route::post('/carregar_agenda', 'evento_agenda_controller@carregar_agenda')->name('carregar_agenda');
        //LISTA OS TIPOS DE FORMULARIOS
        Route::get('/listar_formularios', 'evento_agenda_controller@listar_formularios')->name('listar_formularios');        
        //LISTAR OS EVENTOS POR TIPO DE FORMULARIO
        Route::post('/listar_eventos', 'evento_agenda_controller@listar_eventos')->name('listar_eventos');
        //RETORNA UM EXEMPLO COMPLETO PARA EXIBIÇÃO
        Route::post('/exibir_evento', 'evento_agenda_controller@exibir_evento')->name('exibir_evento');
        //AGENDAR EVENTO
        Route::post('/agendar_evento', 'evento_agenda_controller@agendar_evento')->name('agendar_evento');
        //ENVIAR SUBMISSAO AO EVENTO
        //Route::post('/submeter_evento', 'evento_agenda_controller@submeter_evento')->name('submeter_evento');
        //AGENDAR EVENTO
        Route::post('/eventos_por_data', 'evento_agenda_controller@eventos_por_data')->name('eventos_por_data');
        //POPULAR FORMULARIO
        Route::post('/popular_formulario', 'evento_agenda_controller@popular_furmulario')->name('popular_formulario');
        //LISTAR FORMULARIOS
        Route::get('/formularios_all', 'evento_agenda_controller@formularios_all')->name('formularios_all');
        //LISTAR TEMAS
        Route::get('/temas_all', 'evento_agenda_controller@temas_all')->name('temas_all');
        //LISTAR PROJETOS
        Route::get('/projetos_all', 'evento_agenda_controller@projetos_all')->name('projetos_all');
        //LISTAR PERGUNTAS
        Route::get('/perguntas_all', 'evento_agenda_controller@perguntas_all')->name('perguntas_all');
        //LISTAR OPCOES
        Route::get('/opcoes_all', 'evento_agenda_controller@opcoes_all')->name('opcoes_all');
        //LISTAR OPCOES_PERGUNTAS
        Route::get('/opcoes_perguntas_all', 'evento_agenda_controller@opcoes_perguntas_all')->name('opcoes_perguntas_all'); 
        //LISTA TODAS AS SUBMISSOES SEM POPULAR, DESDE CERTA DATA
        Route::post('/submissoes_por_data', 'evento_agenda_controller@submissoes_por_data')->name('submissoes_por_data');
        //LISTA TODAS AS RESPOSTAS DE SUBMISSAO SEM POPULAR, DESDE CERTA DATA
        Route::post('/ops_por_data', 'evento_agenda_controller@ops_por_data')->name('ops_por_data');     
        //LISTA TODAS AS RESPOSTAS DE SUBMISSAO SEM POPULAR, DESDE CERTA DATA
        Route::post('/resposta_observacao_por_data', 'evento_agenda_controller@resposta_observacao_por_data')->name('resposta_observacao_por_data');
        //LISTA TODAS AS IMAGENS DAS SUBMISSÕES DEPOIS DE CERTA DATA
        Route::post('/imagem_obs_data', 'evento_agenda_controller@imagem_obs_data')->name('imagem_obs_data');
        //LISTA TODAS OS EVENTOS DAS SUBMISSÕES DEPOIS DE CERTA DATA
        Route::post('/eventos_data', 'evento_agenda_controller@eventos_data')->name('eventos_data');  
        //LISTA TODAS AS RESPOSTAS ESCRITAS DAS SUBMISSÕES DEPOIS DE CERTA DATA
        Route::post('/resposta_escrita_por_data', 'evento_agenda_controller@resposta_escrita_por_data')->name('resposta_escrita_por_data'); 
        //LISTA TODAS AS RESPOSTAS_PERGUNTAS ESCRITAS DAS SUBMISSÕES DEPOIS DE CERTA DATA
        Route::post('/resposta_pergunta_por_data', 'evento_agenda_controller@resposta_pergunta_por_data')->name('resposta_pergunta_por_data');
        //LISTA TODAS AS RESPOSTAS_PERGUNTAS SUBMISSAO DAS SUBMISSÕES DEPOIS DE CERTA DATA
        Route::post('/rps_por_data', 'evento_agenda_controller@rps_por_data')->name('rps_por_data');                   
    });

    Route::prefix('cooperado')->group(function () {
        //RETORNA A QUALIDADE DOS COOPERADOS BASEADO NOS PARAMETROS 
        //EXEMPLO: data_referencia: 201701, relatorio: cbt, filtro: >, padrao: 300
        Route::post('/relatorio_qualidade', 'cooperado_controller@relatorio_qualidade')->name('relatorio_qualidade');
        //GERA ARQUIVO EXCEL COM AS QUALIDADES BASEADO NOS PARAMETROS
        Route::post('/gerar_excel_qualidade', 'cooperado_controller@gerar_excel_qualidade')->name('gerar_excel_qualidade');
        //RETORNA TODOS OS COOPERADOS
        Route::get('/listar_cooperados', 'cooperado_controller@listar_cooperados')->name('listar_cooperados');
    });
    Route::prefix('projeto')->group(function () {
        //LISTA OS PROJETOS EM ABERTO
        Route::get('/listar_projeto_abertos', 'projeto_controller@listar_projeto_abertos')->name('listar_projeto_abertos');
    });
});

