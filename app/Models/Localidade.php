<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localidade extends Model
{
    protected $table = 'localidade';
    protected $fillable = [
        'localidade',
        'localidade_pai_id',
        'territorio_turistico_id',
        'zona_turistica_id',
        'uf_id',
        'pais_id',
        'ativo',
        'codimp',
        'populacao',
        'area',
        'altitude',
        'principais_estradas',
        'coelba',
        'embasa',
        'Aniversario',
        'fundacao',
        'nome_padroeiro',
        'dia_padroeiro',
        'dt_turistica_ini',
        'dt_turistica_fim',
        'historico',
        'mp_2009',
        'mp_2013',
        'mp_2016',
        'mp_2017',
        'mp_2019',
        'mp_2021',
        'mp_2023',
        'sj_2007',
        'sj_2008',
        'sj_2009',
        'sj_2010',
        'sj_2011',
        'sj_2012',
        'sj_2013',
        'sj_2014',
        'sj_2015',
        'sj_2016',
        'sj_2017',
        'sj_2018',
        'sj_2019',
        'sj_2020',
        'sj_2021',
        'sj_2022'
    ];

    public $timestamps = false;

    public function territorioTuristico(){

    }

    public function localidadePai(){

    }
    
    public function pais(){
        return $this->hasOne(Pais::class);
    }

    public function uf(){
        return $this->hasOne(UF::class);
    }


}
