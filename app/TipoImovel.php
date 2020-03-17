<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoImovel extends Model
{
    protected $table = 'tipo_imovel';

    protected $fillable = ['nome'];

    public function imoveis()
    {
        return $this->$this->hasMany(Imovel::class, 'tipo_imove_id', 'id');
    }
}
