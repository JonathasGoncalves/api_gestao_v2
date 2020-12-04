<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cooperado;
use App\Http\Resources\RelatorioQualidadeCollection;

class cooperado_controller extends Controller
{

    private $cooperado;

    public function __construct(Cooperado $cooperado)
    {
        $this->cooperado = $cooperado;
    }

    public function relatorio_qualidade(Request $request)
    {
        
        $data = ['qualidades' => RelatorioQualidadeCollection::collection($this->cooperado->relatorio_qualidade($request->data_referencia))];
        return response()->json($data);
    }

}
