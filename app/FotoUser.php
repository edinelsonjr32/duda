<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoUser extends Model
{
    protected $table = 'user_imagem';

    protected $fillable = [
        'user_id',
        'status',
        'path'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
