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

        $cooperados = DB::table('cooperados')
            ->select('cooperados.codigo_cacal', 'cooperados.nome', 'cooperados.MUNICIPIO');
        $todos = DB::table('associados')
        ->select('associados.CODIGO_CACAL', 'associados.NOME', 'associados.MUNICIPIO')
        ->union($cooperados);
        $cooperados_todos = DB::table('tanques')
            ->joinSub($todos, 'todos', function ($join_todos) {
                $join_todos->
                    On('todos.codigo_cacal', '=', 'tanques.codigo_cacal'); 
                })
         ->select(DB::raw(
               'tanques.id,
                todos.nome,
                todos.CODIGO_CACAL,
                todos.MUNICIPIO,
                tanques.tanque,
                tanques.latao'
            ))
        ->distinct()
        ->orderBy('todos.nome')
        ->get();
        
        return $cooperados_todos;
    }
}

