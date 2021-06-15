<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Qualidade extends Model
{
    use HasFactory;

    protected $table = 'qualidade-leite';


    public function ultimas_qualidades($ultima_data) {

        $qualidades = DB::table('qualidade-leite')
        ->select(
            'qualidade-leite.tanque',
            'qualidade-leite.cbt',
            'qualidade-leite.ccs',
            'qualidade-leite.gordura',
            'qualidade-leite.volume',
            'qualidade-leite.faixa'
        )
        ->where('qualidade-leite.zle_dtfim', $ultima_data)
        ->distinct()
        ->get();

        return $qualidades;
    }
}
