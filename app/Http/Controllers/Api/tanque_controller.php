<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanque;
use App\Http\Resources\TanqueResource;

class tanque_controller extends Controller
{
    private $tanque;

    public function __construct(Tanque $tanque)
    {
        $this->tanque = $tanque;
    }

    //RETORNA TODOS OS TECNICOS
    public function tanques_all() {
        $tanques = TanqueResource::collection(Tanque::all());
        if (!$tanques) return response()->json(ApiError::errorMassage('Nenhum tanque encontrado', 404));
        return response()->json(['tanques' => $tanques]);
    }
}
