<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RespostaPergunta extends Model
{
    use HasFactory;
    protected $table = 'resposta_pergunta';

    public function resposta_pergunta_por_data($data_base)
    {
        $resposta_pergunta = DB::table('resposta_pergunta')
            ->select(
                'resposta_pergunta.id',
                'resposta_pergunta.resposta_escrita_id',
                'resposta_pergunta.pergunta_id'
            )
            ->join('resposta_perg_submissao', 'resposta_perg_submissao.resposta_pergunta_id', '=', 'resposta_pergunta.id')
            ->join('submissao', 'resposta_perg_submissao.submissao_id', '=', 'submissao.id')
            ->where('submissao.DataSubmissao', '>=', $data_base)
            ->get();
        return $resposta_pergunta;
    }
}
