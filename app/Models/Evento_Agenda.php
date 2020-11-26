<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento_Agenda extends Model
{
    use HasFactory;

    protected $table = 'evento_agenda';
    protected $fillable = [
        'id', 'data', 'hora', 'tecnico_id', 'fomulario_id', 'tanque_id', 'submissao_id'
    ];
}
