<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventoAgenda extends JsonResource
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
            'aproveitamento'    => $this->aproveitamento,
            'realizada'         => $this->realizada,
            'name'              => $this->name,
            'nome'              => ucwords(strtolower(trim($this->nome))),
            'tanque'            => str_pad(trim($this->tanque), 6, '0', STR_PAD_LEFT),
            'latao'             => str_pad(trim($this->latao), 6, '0', STR_PAD_LEFT),
            'Titulo'            => $this->Titulo,
        ];
    }
}
