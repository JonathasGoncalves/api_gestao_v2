<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaObservacao extends Model
{
    use HasFactory;
    protected $table = 'resposta_observacao';

    /**
     * RespostaObservacao tem muitas imagens
     */
    public function Imagem()
    {
        return $this->hasMany(ImagemObs::class, 'resposta_observacao_id', 'id');
    }
}
