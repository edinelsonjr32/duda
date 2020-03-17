<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = 'visitas';

    protected $fillable = [
        'data_visita',
        'hora',
        'imovel_id',
        'users_id',
        'status',
        'usuario_log'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'imovel_id', 'id');
    }
}
