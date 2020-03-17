<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutorizacaoLocacao extends Model
{
    protected $table = 'autorizacao_locacao';

    protected $fillable = [
        'id',
        'proprietarioId',
        'proprietarioId',
        'taxa',
        'dataInicio',
        'dataFim',
        'texto',
        'status',
        'taxa2',
        'taxa3',
    ];
}
