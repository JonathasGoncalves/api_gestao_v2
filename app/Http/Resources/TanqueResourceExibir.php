<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TanqueResourceExibir extends JsonResource
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
            'tanque'            => str_pad(trim($this->tanque), 6, '0', STR_PAD_LEFT),
            'latao'             => str_pad(trim($this->latao), 6, '0', STR_PAD_LEFT),
            $this->mergeWhen($this->codigo == 7404 and $this->codigo_cacal == 7404, [
                'Cooperado'      => new CooperadoResource($this->Cooperado),
            ]),
            $this->mergeWhen($this->codigo == 7404, [
                'Cooperado'      => new AssociadoResource($this->Associado),
            ]),
            $this->mergeWhen($this->codigo <> 7404, [
                'Cooperado'      => new CooperadoResource($this->Cooperado),
            ]),
        ];
    }
}
