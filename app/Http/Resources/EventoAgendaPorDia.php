<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventoAgendaPorDia extends JsonResource
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
            'data'              => $this->data, 
            'formulario'         => new FormularioResourceExibir($this->formulario), 
            'hora'              => $this->hora, 
            'id'                => $this->id, 
            'submissao_id'      => $this->submissao_id, 
            'tanque'            => new TanqueResourceExibir($this->Tanque),
            'tecnico'           => new TecnicoResourceExibir($this->tecnico),
        ];
    }
}
