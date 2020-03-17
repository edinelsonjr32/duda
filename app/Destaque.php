<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destaque extends Model
{
    protected $fillable = [
        'imovel_id',
        'status'
    ];

    protected $table = 'destaque';
}
