<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cooperado;
use App\Http\Resources\RelatorioQualidade;

class cooperado_controller extends Controller
{

    private $cooperado;

    public function __construct(Cooperado $cooperado)
    {
        $this->cooperado = $cooperado;
    }

    /*
        data_referencia:201701
        relatorio:cbt
        filtro:>
        padrao:300
    */
    public function relatorio_qualidade(Request $request)
    {
        $data = ['qualidades' => RelatorioQualidade::collection($this->cooperado->relatorio_qualidade($request->data_referencia, $request->relatorio, $request->filtro, $request->padrao))];
        return response()->json($data);
    }

}
