<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventoAgendaExibir extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'data'              => $this->data,
            'hora'              => $this->hora,
            'tecnico'           => new TecnicoResourceExibir($this->tecnico),
            'formulario'        => new FormularioResourceExibir($this->formulario),
            'tanque'            => new TanqueResourceExibir($this->Tanque),
            'submissao'         => new SubmissaoResourceExibir($this->Submissao),
        ];
    }
}
