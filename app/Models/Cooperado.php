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
        ->select(
                'tanques.id',
                'todos.nome',
                'todos.CODIGO_CACAL',
                'todos.MUNICIPIO',
                'tanques.tanque',
                'tanques.latao',
                'qualidade-leite.cbt',
                'qualidade-leite.ccs'
            )
        ->distinct()
        ->orderBy('todos.nome')
        ->get();
        
        return $qualidades;
    }

    public function listar_cooperados_todos()
    {

        //BUSCAR A DATA MAIS RECENTE DE QUALIDADE
        $data = DB::table('qualidade-leite')
            ->select(DB::raw('MAX(zle_dtfim) as zle_dtfim'))
            ->get();

        $cooperados = DB::table('cooperados')
            ->select('cooperados.codigo_cacal', 'cooperados.nome', 'cooperados.MUNICIPIO');
        $todos = DB::table('associados')
        ->select('associados.CODIGO_CACAL', 'associados.NOME', 'associados.MUNICIPIO')
        ->union($cooperados);
        $cooperados_todos = DB::table('tanques')
        ->join('qualidade-leite', 'tanques.tanque', '=', 'qualidade-leite.tanque')
        //->where($relatorio, '>=', $padrao)
        ->joinSub($todos, 'todos', function ($join) {
            $join->on('tanques.codigo', '=', 'todos.codigo_cacal');
        })
         ->select(
                'tanques.id',
                'todos.nome',
                'todos.CODIGO_CACAL',
                'todos.MUNICIPIO',
                'tanques.tanque',
                'tanques.latao',
                'qualidade-leite.cbt',
                'qualidade-leite.ccs'
            )
        ->distinct()
        ->where('qualidade-leite.zle_dtfim', '=', $data[0]->zle_dtfim)
        ->orderBy('todos.nome')
        ->get();
        
        return $cooperados_todos;
    }
}

