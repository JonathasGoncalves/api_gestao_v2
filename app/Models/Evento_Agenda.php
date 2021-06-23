<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evento_Agenda extends Model
{
    use HasFactory;

    protected $table = 'eventos_agenda';
    protected $fillable = [
        'id', 'data', 'hora', 'tecnico_id', 'fomulario_id', 'tanque_id', 'submissao_id'
    ];

    /**
     * eventoAgenda tem um tanque
     */
    public function Tecnico()
    {
        return $this->hasOne(Tecnico::class, 'id', 'tecnico_id');
    }

    /**
     * eventoAgenda tem um formulario
     */
    public function Formulario()
    {
        return $this->hasOne(Formulario::class, 'id', 'fomulario_id');
    }

    /**
     * eventoAgenda tem um tanque
     */
    public function Tanque()
    {
        return $this->hasOne(Tanque::class, 'id', 'tanque_id');
    }

     /**
     * eventoAgenda tem uma submissao
     */
    public function Submissao()
    {
        return $this->hasOne(Submissao::class, 'id', 'submissao_id');
    }


    public function CarregarAgenda($dataReferencia)
    {
        $cooperados = DB::table('cooperados')
            ->select('cooperados.codigo_cacal', 'cooperados.nome');

        $todos = DB::table('associados')
            ->select('associados.CODIGO_CACAL', 'associados.NOME')
            ->union($cooperados);

        $eventos = DB::table('eventos_agenda')
            ->select(
                'eventos_agenda.data',
                'submissao.aproveitamento',
                'submissao.realizada',
                'tecnicos.name',
                'todos.nome',
                'tanques.tanque',
                'tanques.latao',
                'formulario.Titulo'
            )
            ->join('submissoes', 'eventos_agenda.submissao_id', '=', 'submissoes.id')
            ->join('tecnicos', 'eventos_agenda.tecnico_id', '=', 'tecnicos.id')
            ->join('tanques', 'submissoes.tanque_id', '=', 'tanques.id')
            ->join('opcao_pergunta_submissao', 'submissoes.id', '=', 'opcao_pergunta_submissao.submissao_id')
            ->join('opcao_pergunta', 'opcao_pergunta_submissao.opcao_pergunta_id', '=', 'opcao_pergunta.id')
            ->join('pergunta', 'opcao_pergunta.pergunta_id', '=', 'pergunta.id')
            ->join('formulario', 'pergunta.formulario_id', '=', 'formulario.id')
            ->joinSub($todos, 'todos', function ($join) {
                $join->on('tanques.codigo', '=', 'todos.codigo_cacal');
            })
            ->where('eventos_agenda.data', '>=', $dataReferencia)
            ->distinct()
            ->get();
        return $eventos;
    }

    public function ListarEventos($formulario)
    {
        $cooperados = DB::table('cooperados')
            ->select('cooperados.codigo_cacal', 'cooperados.nome');

        $todos = DB::table('associados')
            ->select('associados.CODIGO_CACAL', 'associados.NOME')
            ->union($cooperados);

        $eventos = DB::table('eventos_agenda')
            ->select(
                'eventos_agenda.data',
                'submissoes.aproveitamento',
                'submissoes.realizada',
                'tecnicos.name',
                'todos.nome',
                'tanques.tanque',
                'tanques.latao',
                'formulario.Titulo'
            )
            ->join('submissoes', 'eventos_agenda.submissao_id', '=', 'submissoes.id')
            ->join('tecnicos', 'eventos_agenda.tecnico_id', '=', 'tecnicos.id')
            ->join('tanques', 'submissoes.tanque_id', '=', 'tanques.id')
            ->join('opcao_pergunta_submissao', 'submissoes.id', '=', 'opcao_pergunta_submissao.submissao_id')
            ->join('opcao_pergunta', 'opcao_pergunta_submissao.opcao_pergunta_id', '=', 'opcao_pergunta.id')
            ->join('pergunta', 'opcao_pergunta.pergunta_id', '=', 'pergunta.id')
            ->join('formulario', 'pergunta.formulario_id', '=', 'formulario.id')
            ->joinSub($todos, 'todos', function ($join) {
                $join->on('tanques.codigo', '=', 'todos.codigo_cacal');
            })
            ->where('formulario.id', '>=', $formulario)
            ->distinct()
            ->get();
        return $eventos;
    }

    public function evento_agenda_data($data_base)
    {
        $evento_agenda = DB::table('eventos_agenda')
            ->select(
                'eventos_agenda.id',
                'eventos_agenda.data',
                'eventos_agenda.hora',
                'eventos_agenda.tecnico_id',
                'eventos_agenda.fomulario_id',
                'eventos_agenda.tanque_id',
                'eventos_agenda.submissao_id'
            )
            ->join('submissoes', 'evento_agenda.submissao_id', '=', 'submissoes.id')
            ->where('submissoes.DataSubmissao', '>=', $data_base)
            ->get();
        return $evento_agenda;
    }
}
