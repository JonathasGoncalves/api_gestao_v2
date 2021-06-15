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
            'tanque'        => rtrim($this->tanque), 
            'cbt'           => rtrim($this->cbt),
            'ccs'           => rtrim($this->ccs), 
            'gordura'       => rtrim($this->gordura),
            'volume'        => rtrim($this->volume), 
            'faixa'         => rtrim($this->faixa),
        ];
    }
}
