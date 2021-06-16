<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function resposta_observacao_por_data($data_base)
    {

        $ops = DB::table('resposta_observacao')
            ->select(
                'resposta_observacao.id',
                'resposta_observacao.texto_observacao',
                'resposta_observacao.tema_id',
                'resposta_observacao.submissao_id'
            )
            ->join('submissao', 'resposta_observacao.submissao_id', '=', 'submissao.id')
            ->where('submissao.DataSubmissao', '>=', $data_base)
            ->get();
        return $ops;
    }
}
