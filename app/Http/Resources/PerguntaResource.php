<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PerguntaResource extends JsonResource
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
            'id'                =>  $this->id,
            'enunciado'         =>  $this->enunciado,
            'opcoes'            =>  OpcaoResource::collection($this->opcao),
            'tema'              =>  new TemaResource($this->tema),
        ];
    }
}
