<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CooperadoResource extends JsonResource
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
            'codigo_cacal'      => trim(str_pad($this->CODIGO_CACAL, 6, '0', STR_PAD_LEFT)),
            'matricula'         => trim(str_pad($this->matricula, 6, '0', STR_PAD_LEFT)),
            'nome'              => mb_convert_encoding(ucwords(strtolower(trim($this->nome))), 'UTF-8', 'UTF-8'),
            'municipio'         => ucwords(strtolower(trim($this->MUNICIPIO))),
        ];
    }
}
