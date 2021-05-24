<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    protected $table = 'perguntas';

    /**
     * Uma Pergunta tem várias opções;
     */
    public function Opcao()
    {
        return $this->belongsToMany(Opcao::class, 'opcao_perguntas');
    }

    /**
     * Uma Pergunta tem um tema;
     */
    public function Tema()
    {
        return $this->hasOne(Tema::class, 'id', 'tema_id');
    }
}
