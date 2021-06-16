<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OpcaoPerguntaSubmissao extends Model
{
    use HasFactory;
    protected $table = 'opcao_pergunta_submissao';

    public function ops_por_data($data_base)
    {
        $ops = DB::table('opcao_pergunta_submissao')
            ->select(
                'opcao_pergunta_submissao.id',
                'opcao_pergunta_submissao.submissao_id',
                'opcao_pergunta_submissao.opcao_pergunta_id',
            )
            ->join('submissao', 'opcao_pergunta_submissao.submissao_id', '=', 'submissao.id')
            ->where('submissao.DataSubmissao', '>=', $data_base)
            ->get();
        return $ops;
    }

}
