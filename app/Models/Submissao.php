<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submissao extends Model
{
    use HasFactory;
    protected $table = 'submissao';

    /**
     * Submissão tem muitas OpcaoPergunta (Aqui é feita a ligação nxn de Submissão com OpcaoPergunta)
     */
    public function OpcaoPergunta()
    {
        return $this->belongsToMany(OpcaoPergunta::class, 'opcao_pergunta_submissao');
    }

    /**
     * Submissão tem muitas RespostaObservacao
     */
    public function RespostaObservacao()
    {
        return $this->hasMany(RespostaObservacao::class, 'submissao_id', 'id');
    }

     /**
     * Submissão tem uma qualidade
     */
    public function Qualidade()
    {
        return $this->hasOne(Qualidade::class, 'id', 'qualidade_id');
    }
}
