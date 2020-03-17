<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnexoAutorizacaoLocacao extends Model
{
    protected $table = 'anexo_autorizacao_locacao';

    protected $fillable = [
      'path',
      'autorizacaoId',
      'status',
      'nome'
    ];
}
