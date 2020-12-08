<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EventoAgenda;
use App\Models\Evento_Agenda;
use App\Models\Formulario;



class evento_agenda_controller extends Controller
{

    private $evento_agenda;

    public function __construct(Evento_Agenda $evento_agenda)
    {
        $this->evento_agenda = $evento_agenda;
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
        $data = ['formularios' => Formulario::all()];
        return response()->json($data);
    }

    //Retorna um evento completo para exibição
    public function exibir_evento(Request $request) {
        $data = ['evento' => new EventoAgenda(Evento_Agenda::find($request->id_evento))];
        return response()->json($data);
    }
}
