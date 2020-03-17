<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Imovel extends Model
{
    use Notifiable;

    protected $table = 'imovel';

    protected $fillable = [
        'tipo_imovel',
        'venda',
        'aluguel',
        'valor_venda',
        'taxas_extras',
        'contribuicao',
        'valor_aluguel',
        'proprietario_id',
        'impostos',
        'imposto_valor',
        'condominio',
        'mapa',
        'descricao',
        'banheiros',
        'suites',
        'salas',
        'garagem',
        'garagem_coberta',
        'area_total',
        'area_util',
        'cep',
        'endereco',
        'latitude',
        'longitude',
        'bairro',
        'complemento',
        'cidade',
        'estado',

        'ar_condicionado',
        'bar',
        'livraria',
        'churrasqueira',
        'cozinha_equipada',
        'cozinha_planejada',
        'cozinha',
        'cozinha_americana',
        'escritorio',
        'lavatorio',
        'piscina',
        'status',
        'destaque',
        'user_id',
        'numero',
        'quartos',
        'despensa',
        'edicula',
        'titulo',
        'copa',
        'terraco',
        'quarto_empregada',
        'banheiro_empregada',
        'sala_com_lareira',
        'banheiro_social',
        'placa',
        'documentado',
        'recibo_compra_venda',
        'exclusividade',
        'matricula_celpa',
        'matricula_cosanpa',
        'tamanho_frente',
        'tamanho_fundo',
        'cerca_eletrica',
        'poco_artesiano',
        'portao_eletronico',
        'concertina',
        'elevador',
        'escada',
        'interfone',
    ];

    public function setCopaAttribute($value)
    {
        $this->attributes['copa'] = (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setCozinhaAttribute($value)
    {
        $this->attributes['cozinha'] = (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setCozinhaPlanejadaAttribute($value)
    {
        $this->attributes['cozinha_planejada'] = (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setImpostoValorAttribute($value)
    {
        $this->attributes['imposto_valor'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setPocoArtesianoAttribute($value)
    {
        $this->attributes['poco_artesiano'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setPortaoEletronicoAttribute($value)
    {
        $this->attributes['portao_eletronico'] = (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setCercaEletricaAttribute($value)
    {
        $this->attributes['cerca_eletrica'] = (($value == true || $value == 'on') ? 1 : 0);
    }


    public function setElevadorAttribute($value)
    {
        $this->attributes['elevador']= (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setInterfoneAttribute($value)
    {
        $this->attributes['interfone']= (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setEscadaAttribute($value)
    {
        $this->attributes['escada']= (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setConcertinaAttribute($value)
    {
        $this->attributes['concertina']= (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setQuartoEmpregadaAttribute($value)
    {
        $this->attributes['quarto_empregada'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setBanheiroEmpregadaAttribute($value)
    {
        $this->attributes['banheiro_empregada'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setSalaComLareiraAttribute($value)
    {
        $this->attributes['sala_com_lareira'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setBanheiroSocialAttribute($value)
    {
        $this->attributes['banheiro_social'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setPlacaAttribute($value)
    {
        $this->attributes['placa'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setDocumentadoAttribute($value)
    {
        $this->attributes['documentado'] = (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setTerracoAttribute($value)
    {
        $this->attributes['terraco'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setReciboCompraVendaAttribute($value)
    {
        $this->attributes['recibo_compra_venda'] = (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setExclusividadeAttribute($value)
    {
        $this->attributes['exclusividade'] = (($value == true || $value == 'on') ? 1 : 0);
    }





    public function proprietario()
    {
        return $this->belongsTo(Proprietario::class, 'proprietario_id', 'id');
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class, 'imovel_id', 'id');
    }
    public function imagens()
    {
        return $this->hasMany(ImagemImovel::class, 'imovel_id', 'id');
    }




    public function setArCondicionadoAttribute($value)
    {
        $this->attributes['ar_condicionado'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setBarAttribute($value)
    {
        $this->attributes['bar'] = (($value == true || $value == 'on') ? 1 : 0);
    }


    public function setChurrasqueiraAttribute($value)
    {
        $this->attributes['churrasqueira'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setCozinhaAmericanaAttribute($value)
    {
        $this->attributes['cozinha_americana'] = (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setDespensaAttribute($value)
    {
        $this->attributes['despensa'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setCozinhaEquipadaAttribute($value)
    {
        $this->attributes['cozinha_equipada'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setEscritorioAttribute($value)
    {
        $this->attributes['escritorio'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setLavatorioAttribute($value)
    {
        $this->attributes['lavatorio'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setMobiliadoAttribute($value)
    {
        $this->attributes['mobiliado'] = (($value == true || $value == 'on') ? 1 : 0);
    }
    public function setPiscinaAttribute($value)
    {
        $this->attributes['piscina'] = (($value == true || $value == 'on') ? 1 : 0);
    }

    public function setEdiculaAttribute($value)
    {
        $this->attributes['edicula'] = (($value == true || $value == 'on') ? 1 : 0);
    }


    public function setLivrariaAttribute($value)
    {
        $this->attributes['livraria'] = ($value == true || $value == 'on' ? 1 : 0);
    }


    public function setValorAluguelAttribute($value)
    {
        if(empty($value)){
            $this->attributes['valor_aluguel'] = null;
        } else {
            $this->attributes['valor_aluguel'] = $this->converterParaDouble($value);
        }
    }
    public function setValorVendaAttribute($value)
    {
        if(empty($value)){
            $this->attributes['valor_venda'] = null;
        } else {
            $this->attributes['valor_venda'] = $this->converterParaDouble($value);
        }
    }
    public function setImpostosAttribute($value)
    {
        if(empty($value)){
            $this->attributes['impostos'] = null;
        } else {
            $this->attributes['impostos'] = $this->converterParaDouble($value);
        }
    }
    public function setContricuicaoAttribute($value)
    {
        if(empty($value)){
            $this->attributes['contribuicao'] = null;
        } else {
            $this->attributes['contribuicao'] = $this->converterParaDouble($value);
        }
    }
    public function setTaxasExtrasAttribute($value)
    {
        if(empty($value)){
            $this->attributes['taxas_extras'] = null;
        } else {
            $this->attributes['taxas_extras'] = $this->converterParaDouble($value);
        }
    }
    public function setAreaTotalAttribute($value)
    {
        if(empty($value)){
            $this->attributes['area_total'] = null;
        } else {
            $this->attributes['area_total'] = $this->converterParaDouble($value);
        }
    }
    public function setTamanhoFrenteAttribute($value)
    {
        if(empty($value)){
            $this->attributes['tamanho_frente'] = null;
        } else {
            $this->attributes['tamanho_frente'] = $this->converterParaDouble($value);
        }
    }
    public function setTamanhoFundoAttribute($value)
    {
        if(empty($value)){
            $this->attributes['tamanho_fundo'] = null;
        } else {
            $this->attributes['tamanho_fundo'] = $this->converterParaDouble($value);
        }
    }
    public function setAreaUtilAttribute($value)
    {
        if(empty($value)){
            $this->attributes['area_util'] = null;
        } else {
            $this->attributes['area_util'] = $this->converterParaDouble($value);
        }
    }
    public function setCondominioAttribute($value)
    {
        if(empty($value)){
            $this->attributes['condominio'] = null;
        } else {
            $this->attributes['condominio'] = $this->converterParaDouble($value);
        }
    }

    public function converterParaDouble($valor)
    {
        $valorAluguel = str_replace('.', '', $valor);
        $valorAluguel2 = str_replace(',', '.', $valorAluguel);

        return $valorAluguel2;
    }

}
