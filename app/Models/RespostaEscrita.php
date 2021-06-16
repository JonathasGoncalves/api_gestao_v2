<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RespostaEscrita extends Model
{
    use HasFactory;
    protected $table = 'resposta_escrita';

    public function resposta_escrita_por_data($data_base)
    {
        $ops = DB::table('resposta_escrita')
            ->select(
                'resposta_escrita.id',
                'resposta_escrita.valor'
            )
            ->join('resposta_pergunta', 'resposta_pergunta.resposta_escrita_id', '=', 'resposta_escrita.id')
            ->join('resposta_perg_submissao', 'resposta_perg_submissao.resposta_pergunta_id', '=', 'resposta_pergunta.id')
            ->join('submissao', 'resposta_perg_submissao.submissao_id', '=', 'submissao.id')
            ->where('submissao.DataSubmissao', '>=', $data_base)
            ->get();
        return $ops;
    }
}