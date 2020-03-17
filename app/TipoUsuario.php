<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipo_usuarios';

    protected $fillables = [

        'nome', 'status'
    ];

    public function usuarios()
    {
        return $this->hasMany(User::class, 'tipo_user_id', 'id');
    }
}
