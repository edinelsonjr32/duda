<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'email';


    protected $fillable = [
      'nome',
      'email',
      'telefone',
      'mensagem',
      'status',
      'lido',
      'titulo',
      'enviado',
      'recebido',
    ];
}
