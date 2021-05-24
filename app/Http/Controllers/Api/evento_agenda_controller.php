<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EventoAgenda; 
use App\Http\Resources\EventoAgendaExibir;
use App\Http\Resources\EventoAgendaPorDia;
use App\Http\Resources\FormularioResourceExibir;
use App\Http\Resources\TemaResource;
use App\Http\Resources\ProjetoResource;
use App\Models\Evento_Agenda;
use App\Models\Formulario;
use App\Models\Tema;
use App\Models\Pergunta;
use App\Models\Submissao;
use App\Models\Projeto; 
use App\Models\Opcao;
use App\Models\OpcaoPergunta;
use Illuminate\Support\Facades\DB;


class evento_agenda_controller extends Controller
{

    private $evento_agenda;
    private $formulario;

    public function __construct(Evento_Agenda $evento_agenda, Formulario $formulario)
    {
        $this->evento_agenda = $evento_agenda;
        $this->formulario = $formulario;
    }

    //lista os eventos para apresentar na tela inicial da agenda
    public function carregar_agenda(Request $request)
    {
        $data = ['eventos' => EventoAgenda::collection($this->evento_agenda->CarregarAgenda($request->data_referencia))];
        return response()->json($data);
    }

    //lista os eventos por tipo de formulario
    public function listar_eventos(Request $request)
    {
        $data = ['eventos' => EventoAgenda::collection($this->evento_agenda->ListarEventos($request->formulario))];
        return response()->json($data);
    }

    //lista os tipos de Formulario disponiveis
    public function listar_formularios() {
        $data = ['formularios' => $this->formulario->listar_formularios()];
        return response()->json($data);
    }

    //Retorna um evento completo para exibição
    public function exibir_evento(Request $request) {
        $data = ['evento' => new EventoAgendaExibir(Evento_Agenda::find($request->id_evento))];
        return response()->json($data);
    }

    //Cria um novo evento para a agenda
    public function agendar_evento(Request $request) {
        
        $Evento_all = $request->all();
        try {
            DB::beginTransaction();
            $Evento_all = $request->all();
            //criando submissao pertencete a este evento
            $submissao =  Submissao::create([
                'DataSubmissao' => $Evento_all['DataSubmissao'] . " " . $Evento_all['hora'],
                //'qualidade_id' => $Evento_all['qualidade_id'],
                'projeto_id' => $Evento_all['projeto_id'],
                'tanque_id' => $Evento_all['tanque_id'],
                'realizada' => 0,
                'tecnico_id' => $Evento_all['tecnico_id'],
                'aproveitamento' => 0,
            ]);

            $evento =  Evento_Agenda::create([
                'data' => $Evento_all['DataSubmissao'],
                'hora' => $Evento_all['hora'],
                'tecnico_id' => $Evento_all['tecnico_id'],
                'fomulario_id' => $Evento_all['fomulario_id'],
                'tanque_id' => $Evento_all['tanque_id'],
                'submissao_id' => $submissao->id,
            ]);
            DB::commit();
            return $evento;
        } catch (Exception $e) {
            DB::rollback();
            if (config('app.debug')) {
                return response()->json(ApiError::errorMassage($e, 4000));
            }
            return response()->json(ApiError::errorMassage('Error ao inserir o Evento', 4000));
        }
    }

    public function eventos_por_data(Request $request) {
        $data = ['eventos' => EventoAgendaPorDia::collection($this->evento_agenda->where('data', '>=', $request->input('data'))->orderBy('hora')->get())->groupBy('data')];
        return response()->json($data);
    }

    public function pupular_furmulario(Request $request) {
        $formulario = $request->formulario_id;
        $temas = Tema::all();

        $perguntas = Pergunta::cursor($formulario)->filter(function ($pergunta, $formulario) {
            return $pergunta->formulario_id == $formulario;
        });

        return $perguntas;
    }

    public function formularios_all() {
        $formularios = FormularioResourceExibir::collection(Formulario::all());
        if (!$formularios) return response()->json(ApiError::errorMassage('Nenhum formulário cadastrado', 404));
        return response()->json(['formularios' => $formularios]);
    }

    public function temas_all() {
        $temas = TemaResource::collection(Tema::all());
        if (!$temas) return response()->json(ApiError::errorMassage('Nenhum tema cadastrado', 404));
        return response()->json(['formularios' => $temas]);
    }
    
    public function projetos_all() {
        $temas = ProjetoResource::collection(Projeto::all());
        if (!$temas) return response()->json(ApiError::errorMassage('Nenhum projeto cadastrado', 404));
        return response()->json(['projetos' => $temas]);
    }

    public function perguntas_all() {
        $perguntas = Pergunta::all();
        if (!$perguntas) return response()->json(ApiError::errorMassage('Nenhuma pergunta cadastrada', 404));
        return response()->json(['perguntas' => $perguntas]);
    }
    
    public function opcoes_all() {
        $opcoes = Opcao::all();
        if (!$opcoes) return response()->json(ApiError::errorMassage('Nenhuma opcao cadastrada', 404));
        return response()->json(['opcoes' => $opcoes]);
    }

    public function opcoes_perguntas_all() {
        $opcoes_perguntas = OpcaoPergunta::all();
        if (!$opcoes_perguntas) return response()->json(ApiError::errorMassage('Nenhuma opcao_pergunta cadastrada', 404));
        return response()->json(['opcoes_perguntas' => $opcoes_perguntas]);
    }
    
}
