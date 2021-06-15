<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualidade;
use App\Http\Resources\QualidadeResource;


class QualidadeController extends Controller
{
    private $qualidade;

    public function __construct(Qualidade $qualidade)
    {
        $this->qualidade = $qualidade;
    }

    //RETORNA TODOS OS TECNICOS
    public function ultimas_qualidades() {
        $ultima_data = Qualidade::max('zle_dtfim');
        $qualidades = QualidadeResource::collection($this->qualidade->ultimas_qualidades($ultima_data));
        if (!$qualidades) return response()->json(ApiError::errorMassage('Nenhuma qualidade encontrada', 404));
        return response()->json(['qualidades' => $qualidades]);
    }
}
