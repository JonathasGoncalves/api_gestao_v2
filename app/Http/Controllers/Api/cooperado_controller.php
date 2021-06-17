<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cooperado;
use App\Http\Resources\RelatorioQualidade;   
use App\Http\Resources\CooperadoResource; 
use App\Http\Resources\RelatorioQualidadeExport;
use Excel;
use App\Exports\QualidadeExport;

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

    //GERAR EXCEL DAS QUALIDADES
    public function gerar_excel_qualidade(Request $request)
    {
        $criado = Excel::store(new QualidadeExport($request->data_referencia, $request->relatorio, $request->filtro, $request->padrao), 'qualidades.xlsx');
        if (!$criado) return response()->json(ApiError::errorMassage(['data' => ['msg' => 'Não foi possivel gerar o arquivo!']], 4040), 404);
        return response()->json($criado);
    }

    //LISTA TODOS OS COOPERADOS
    public function listar_cooperados()
    {
        //ini_set('max_execution_time', 300);
        $data = ['cooperados' => CooperadoResource::collection($this->cooperado->listar_cooperados_todos())];
        //$data = ['cooperados' => $this->cooperado->listar_cooperados_todos()];
        return response()->json($data);
    }

}
