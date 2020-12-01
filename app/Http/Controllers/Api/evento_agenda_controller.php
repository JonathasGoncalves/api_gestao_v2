<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\EventoAgendaCollection;
use App\Models\Evento_Agenda;



class evento_agenda_controller extends Controller
{

    private $evento_agenda;

    public function __construct(Evento_Agenda $evento_agenda)
    {
        $this->evento_agenda = $evento_agenda;
    }

    public function carregar_agenda(Request $request)
    {
        $data = ['eventos' => EventoAgendaCollection::collection($this->evento_agenda->CarregarAgenda($request->data_referencia))];
        return response()->json($data);
    }
}
