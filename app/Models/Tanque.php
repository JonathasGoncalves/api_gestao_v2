<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanque extends Model
{
    use HasFactory;

    protected $table = 'tanques';

    /**
     * Tanque tem um Associado
     */
    public function Associado()
    {
        return $this->hasOne(Associado::class, 'CODIGO_CACAL', 'codigo_cacal');
    }

    /**
     * Tanque tem um cooperado
     */
    public function Cooperado()
    {
        return $this->hasOne(Cooperado::class, 'codigo', 'codigo');
    }
}
