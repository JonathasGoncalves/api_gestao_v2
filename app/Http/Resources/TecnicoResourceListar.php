<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TecnicoResourceListar extends JsonResource
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
            'id'        => $this->id,
            'nome'      => $this->name,
            'email'     => $this->email
        ];
    }
}
