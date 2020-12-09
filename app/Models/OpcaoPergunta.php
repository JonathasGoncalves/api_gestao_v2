<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcaoPergunta extends Model
{
    use HasFactory;
    protected $table = 'opcao_pergunta';

    /**
     * OpcaoPergunta tem uma pergunta. 
     */
    public function Pergunta()
    {
        return $this->hasOne(Pergunta::class, 'id', 'pergunta_id');
    }

    /**
     * OpcaoPergunta tem uma opcao. 
     */
    public function Opcao()
    {
        return $this->hasOne(Opcao::class, 'id', 'opcao_id');
    }
}
