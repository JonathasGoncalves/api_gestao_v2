<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RespostaObservacaoResource extends JsonResource
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
            'texto_observacao'      => $this->texto_observacao,
            'imagens'               => ImagemResource::collection($this->imagem),
        ];
    }
}
