<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Tecnico extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'tecnico';

    protected $fillable = [
        'nome',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //DEFININDO QUE A BUSCA É FEITA POR NOME E NÃO POR E-MAIL
    public function findForPassport($name)
    {
        return $this->where('nome', $name)->first();
    }
}
