<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Proprietario extends Model
{
    use Notifiable;

    protected  $fillable = [
        'nome',
        'tipo_proprietario_id',
        'email',
        'telefone' ,
        'rua',
        'cep',
        'bairro',
        'usuario_id',
        'profissao',
        'nacionalidade',
        'tipo_conta',
        'variacao_poupanca',
        'cpf',
        'data_nascimento',
        'rg',
        'banco',
        'agencia',
        'conta',
        'cidade',
        'numero_casa',
        'estado',
        'cnpj',
        'nome_fantasia',
        'nome_empresa',
        'contrato_social',
        'orgao_emissor',
        'estado_civil'
    ];
    protected $table = 'proprietario';

    public function tipoProprietario()
    {
        return $this->belongsTo(TipoProprietario::class, 'tipo_proprietario_id', 'id');
    }

    public function imoveis()
    {
        return $this->hasMany(Imovel::class, 'proprietario_id', 'id')
            ->orderBy('created_at', 'ASC');
    }


}
