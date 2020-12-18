<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projeto;

class projeto_controller extends Controller
{

    private $projeto;

    public function __construct(Projeto $projeto)
    {
        $this->projeto = $projeto;
    }

    public function listar_projeto_abertos() {
        $data = ['projetos' => Projeto::where('aberto', '=', '1')->get()];
        return response()->json($data);
    }
    
}
