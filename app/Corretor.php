<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corretor extends Model
{
    protected $table = 'corretor';

    protected $fillable = [
        'nome',
        'telefone',
        'codigo',
        'path'
    ];
}
