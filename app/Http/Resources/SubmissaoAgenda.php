<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubmissaoAgenda extends JsonResource
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
            'DataSubmissao'     => $this->DataSubmissao,
            'qualidade_id'      => $this->qualidade_id,
            'realizada'         => $this->realizada,
            'aproveitamento'    => $this->aproveitamento,
        ];
    }
}