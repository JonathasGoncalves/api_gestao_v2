<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RelatorioQualidade extends JsonResource
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
            'nome'              => mb_convert_encoding(ucwords(strtolower(trim($this->nome))), 'UTF-8', 'UTF-8'),
            'municipio'         => ucwords(strtolower(trim($this->MUNICIPIO))),
            'tanque'            => str_pad(trim($this->tanque), 6, '0', STR_PAD_LEFT),
            'latao'             => str_pad(trim($this->latao), 6, '0', STR_PAD_LEFT),
            'cbt'               => $this->cbt,
            'ccs'               => $this->ccs,
        ];
    }
}
