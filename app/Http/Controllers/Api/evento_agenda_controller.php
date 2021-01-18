<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EventoAgenda; 
use App\Http\Resources\EventoAgendaExibir;
use App\Models\Evento_Agenda;
use App\Models\Formulario;
use App\Models\Submissao;
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
}
