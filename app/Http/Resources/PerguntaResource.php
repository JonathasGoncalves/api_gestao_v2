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
            'enunciado'         =>  $this->enunciado,
            'opcoes'            =>  OpcaoResource::collection($this->opcao),
            'tema'              =>  new TemaResource($this->tema),
        ];
    }
}
