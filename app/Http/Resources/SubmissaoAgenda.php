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
            'data_submissao'    => $this->data_submissao,
            'realizada'         => $this->realizada,
            'aproveitamento'    => $this->aproveitamento,
        ];
    }
}
