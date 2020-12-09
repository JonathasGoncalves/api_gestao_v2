<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemObs extends Model
{
    use HasFactory;
    protected $table = 'imagem_obs';
    protected $fillable = [
        'uri', 'resposta_observacao_id'
    ];
}
