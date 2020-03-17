<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoProprietario extends Model
{
    protected $table = 'documentos_proprietario';

    protected $fillable = [
        'path',
        'proprietario_id',
        'status',
    ];
}
