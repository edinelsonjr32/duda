<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ImagemImovel extends Model
{
    use Notifiable;
    protected $fillable = ['imovel_id', 'path'];

    protected $table = 'imovel_imagem';

    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'imovel_id', 'id');
    }
}
