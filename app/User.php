<?php

namespace App;

use Carbon\Traits\Timestamp;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Timestamp;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'tipo_user_id', 'status', 'apelido', 'image', 'creci'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_user_id', 'id');
    }
    public function visitas(){
        return $this->hasMany(Visita::class, 'users_id', 'id');
    }
    public function fotos(){
        return $this->hasMany(FotoUser::class, 'user_id', 'id');
    }
}
