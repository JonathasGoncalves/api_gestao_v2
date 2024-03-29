<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImagemObs extends Model
{
    use HasFactory;
    protected $table = 'imagem_obs';
    protected $fillable = [
        'uri', 'resposta_observacao_id'
    ];

    public function imagem_obs_data($data_base)
    {
        $ops = DB::table('opcao_pergunta_submissao')
            ->select(
                'imagem_obs.id',
                'imagem_obs.resposta_observacao_id',
                'imagem_obs.uri',
            )
            ->join('submissao', 'opcao_pergunta_submissao.submissao_id', '=', 'submissao.id')
            ->join('imagem_obs', 'opcao_pergunta_submissao.id', '=', 'imagem_obs.resposta_observacao_id')
            ->where('submissao.DataSubmissao', '>=', $data_base)
            ->get();
        return $ops;
    }

}
