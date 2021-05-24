<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tecnico;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\API\ApiError;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser;
use Exception;
use Auth;
use App\Http\Resources\TecnicoResourceListar;



class TecnicoController extends Controller
{
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $TecnicoData = $request->all();
            $tecnico_new =  Tecnico::create([
                'name' => $TecnicoData['name'],
                'email' => $TecnicoData['email'],
                'password' => Hash::make($TecnicoData['password']),
            ]);
            DB::commit();
            return $tecnico_new;
        } catch (Exception $e) {
            DB::rollback();
            if (config('app.debug')) {
                return response()->json(ApiError::errorMassage($e, 4000));
            }
            return response()->json(ApiError::errorMassage('Error ao inserir o tecnico', 4000));
        }
    }

    //RETORNA O TÉCNICO LOGADO
    public function userLogged()
    {
        return Auth::user();
    }

    //RETORNA TODOS OS TECNICOS
    public function tecnicos_all() {
        $tecnicos = TecnicoResourceListar::collection(Tecnico::all());
        if (!$tecnicos) return response()->json(ApiError::errorMassage('Nenhum técnico cadastrado', 404));
        return response()->json(['Tecnicos' => $tecnicos]);
    }
}
