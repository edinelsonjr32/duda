<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImovelAutorizacaoLocacao extends Model
{
    protected $table = 'imovel_autorizacao_locacao';

    protected $fillable = [
        'autorizacaoLocacaoId',
        'status'
    ];
}
