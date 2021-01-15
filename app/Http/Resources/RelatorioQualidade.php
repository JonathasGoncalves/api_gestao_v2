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
            'qualidade_id'      => trim($this->qualidade_id),
            'id'                => trim($this->id),
            'codigo_cacal'      => trim(str_pad($this->CODIGO_CACAL, 6, '0', STR_PAD_LEFT)),
            'nome'              => mb_convert_encoding(ucwords(strtolower(trim($this->nome))), 'UTF-8', 'UTF-8'),
            'municipio'         => ucwords(strtolower(trim($this->MUNICIPIO))),
            'tanque'            => trim(str_pad($this->tanque, 6, '0', STR_PAD_LEFT)),
            'latao'             => trim(str_pad($this->latao, 6, '0', STR_PAD_LEFT)),
            'cbt'               => $this->cbt,
            'ccs'               => $this->ccs,
        ];
    }
}
