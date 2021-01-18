<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Formulario extends Model
{
    use HasFactory;
    protected $table = 'formulario';

    public function listar_formularios() {

        $formularios = DB::table('formulario')
        ->select('formulario.id', 'formulario.Titulo')
        ->get();

        return $formularios;
    }

}
