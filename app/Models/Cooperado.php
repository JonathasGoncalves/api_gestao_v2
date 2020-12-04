<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cooperado extends Model
{
    use HasFactory;

    public function relatorio_qualidade($dataReferencia)
    {
        $cooperados = DB::table('cooperados')
            ->select('cooperados.codigo_cacal', 'cooperados.nome', 'cooperados.MUNICIPIO');

        $todos = DB::table('associados')
            ->select('associados.CODIGO_CACAL', 'associados.NOME', 'associados.MUNICIPIO')
            ->union($cooperados);

        $qualidades = DB::table('tanques')
            ->select(
                'todos.nome',
                'todos.MUNICIPIO',
                'tanques.tanque',
                'tanques.latao',
                'qualidade-leite.cbt',
                'qualidade-leite.ccs',
            )
            ->join('qualidade-leite', 'tanques.tanque', '=', 'qualidade-leite.tanque')
            ->joinSub($todos, 'todos', function ($join) {
                $join->on('tanques.codigo', '=', 'todos.codigo_cacal');
            })
            ->where('qualidade-leite.zle_dtfim', '=', $dataReferencia)
            ->distinct()
            ->get();
        return $qualidades;
    }

}
