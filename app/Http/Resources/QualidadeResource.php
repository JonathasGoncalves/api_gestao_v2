<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class QualidadeResource extends JsonResource
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
            'id'            => rtrim($this->id), 
            'mes_ano'       => $this->mes_ano,
            'tanque'        => trim(str_pad($this->tanque, 6, '0', STR_PAD_LEFT)), 
            'cbt'           => rtrim($this->cbt),
            'ccs'           => rtrim($this->ccs), 
            'est'           => rtrim($this->est),
            'gordura'       => rtrim($this->gordura),
            'volume'        => rtrim($this->volume), 
            'faixa'         => rtrim($this->faixa),
            'matricula'     => trim(str_pad($this->matricula, 6, '0', STR_PAD_LEFT))
        ];
    }
}
