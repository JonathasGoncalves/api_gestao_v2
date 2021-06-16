<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RespostaPerguntaSubmissao extends Model
{
    use HasFactory;
    protected $table = 'resposta_perg_submissao';

    public function rps_por_data($data_base)
    {
        $ops = DB::table('resposta_perg_submissao')
            ->select(
                'resposta_perg_submissao.id',
                'resposta_perg_submissao.submissao_id',
                'resposta_perg_submissao.resposta_pergunta_id',
            )
            ->join('submissao', 'resposta_perg_submissao.submissao_id', '=', 'submissao.id')
            ->where('submissao.DataSubmissao', '>=', $data_base)
            ->get();
        return $ops;
    }
}
