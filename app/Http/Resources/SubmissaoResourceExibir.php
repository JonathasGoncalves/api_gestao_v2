<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubmissaoResourceExibir extends JsonResource
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
            'DataSubmissao'     => $this->DataSubmissao,
            'qualidade'         => new QualidadeResource($this->Qualidade),
            'Respostas'         => OpcaoPerguntaResource::collection($this->OpcaoPergunta),
            'observacoes'       => RespostaObservacaoResource::collection($this->RespostaObservacao),
            'realizada'         => $this->realizada,
            'aproveitamento'    => $this->aproveitamento,
        ];
    }
}
