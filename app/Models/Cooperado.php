<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cooperado extends Model
{
    use HasFactory;
    

    public function relatorio_qualidade($data_referencia, $relatorio, $filtro, $padrao)
    {

        $filtroPadrao = true;
        if($filtro != '<=') {
            $filtroPadrao = false;
        }

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
        //->select(DB::raw('CONCAT(qualidade-leite.id, tanque.id) as chave'),'qualidade-leite.tanque', 'todos.codigo', 'todos.codigo_cacal', 'todos.nome', 'todos.MUNICIPIO', 'tanques.id', 'qualidade-leite.cbt', 'qualidade-leite.ccs', 'qualidade-leite.zle_dtfim', 'tanques.id' , 'qualidade-leite.id')
        ->join('qualidade-leite', 'tanques.tanque', '=', 'qualidade-leite.tanque')
        ->when($filtroPadrao, function ($q) use ($relatorio, $padrao, $data_referencia) {
            return $q->where($relatorio, '<=', $padrao)->where('zle_dtfim', '=', $data_referencia);
        })
        ->when(!$filtroPadrao, function ($q) use ($relatorio, $padrao, $data_referencia) {
            return $q->where($relatorio, '>', $padrao)->where('zle_dtfim', '=', $data_referencia);
        })
        //->where($relatorio, '>=', $padrao)
        ->joinSub($todos, 'todos', function ($join) {
            $join->on('tanques.codigo', '=', 'todos.codigo_cacal');
        })
        ->distinct()
        ->get();
        
        return $qualidades;
    }

}
