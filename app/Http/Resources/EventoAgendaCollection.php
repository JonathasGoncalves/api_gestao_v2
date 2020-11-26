<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventoAgendaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'cooperado'         => ucwords(strtolower(trim($this->nome_cooperado))),
            'tanque'            => str_pad(trim($this->tanque), 6, '0', STR_PAD_LEFT),
            'latão'             => str_pad(trim($this->latao), 6, '0', STR_PAD_LEFT),
            'relatório'         => $this->relatorio,
            'data'              => $this->data,
            'tecnico'           => $this->tecnico,
            'realizada'         => $this->realizada,
            'aproveitamento'    => $this->aproveitamento,
        ];
    }
}
