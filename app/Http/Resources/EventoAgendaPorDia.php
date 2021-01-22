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
            'fomulario_id'      => new FormularioResourceExibir($this->formulario), 
            'hora'              => $this->hora, 
            'id'                => $this->id, 
            'submissao_id'      => $this->submissao_id, 
            'tanque_id'         => new TanqueResourceExibir($this->Tanque),
            'tecnico_id'        => new TecnicoResourceExibir($this->tecnico),
        ];
    }
}
