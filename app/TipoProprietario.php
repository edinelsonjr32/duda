<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProprietario extends Model
{
    protected $table = 'tipo_proprietario';
    protected $fillable = ['nome'];


    public function proprietarios()
    {
        return $this->hasMany(Proprietario::class, 'proprietario_id', 'id');
    }
}
