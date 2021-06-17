@extends('layouts.modals')
@section('modal-header')
    <i class="fa fa-list"> </i> Informações do Projeto
@endsection     
@section('modal_content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <b>  Nome do projeto: </b> 
                </div>    
                <div class="col-md-6">
                    <p> {{ $projeto->nome_projeto }} </p> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b> Número do processo: </b>
                </div>
                <div class="col-md-6">
                    <p> {{ $projeto->processo }} </p>
                </div>  
            </div>
            <div class="row"> 
                <div class="col-md-6">
                    <b> Data inicio: </b> 
                </div>
                <div class="col-md-6">
                    <p> {{ converteData($projeto->dt_inicio, 'd/m/Y') }} </p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6">
                    <b> Data fim:</b> 
                </div>
                <div class="col-md-6">
                    <p> {{ converteData($projeto->dt_fim, 'd/m/Y') }} </p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6">
                    <b> Data lançamento: </b>
                </div>
                <div class="col-md-6">
                    <p> {{ converteData($projeto->dt_lancamento, 'd/m/Y H:i:s') }} </p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6">
                    <b> Setor de Origem: </b>
                </div>
                <div class="col-md-6">
                    <p> {{ $projeto->descsetor }}  </p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6">
                    <b> Tipo de Processo:  </b>
                </div>
                <div class="col-md-6">
                    <p> {{ $projeto->nome_proponente == "S" ? "Via Sei" : "Projeto Físico" }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b> Tipo de Projeto: </b>
                </div>
                <div class="col-md-6">
                    <p> {{ $projeto->nome_tipo_projeto }}  </p> 
                </div>
            </div>

            <div class="row"> 
                <div class="col-md-6">
                    <b> Nome do Proponente  </b>
                </div>
                <div class="col-md-6">
                    <p> {{ $projeto->nome_proponente }}</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6">
                    <b> Localidade  </b>
                </div>
                <div class="col-md-6">
                    <p> {{ $projeto->localidade }}</p>
                </div>
            </div>
            <div class="row"> 
                <div class="col-md-6">
                    <b> Modalidade de Apoio </b>
                </div>
                <div class="col-md-6">
                    <p> {{ $projeto->modalidade_apoio }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b> Valor Solicitado </b>
                </div>
                <div class="col-md-6">
                    <p> 
                        {{ !empty($projeto->valor_solicitado) 
                            ? "R$ ".number_format($projeto->valor_solicitado, 2) 
                            : "Não informado" 
                        }} 
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b> Valor Aprovado </b>
                </div>
                <div class="col-md-6">
                    <p> {{ !empty($projeto->valor_aprovado_total) 
                            ? "R$ ".number_format($projeto->valor_aprovado_total, 2) 
                            : "Não informado"
                        }} </p> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b> Situação do Projeto </b>
                </div>  
                <div class="col-md-6">
                    <p>   
                        @php 
                            $label = $content = "";
                            switch ($projeto->situacao_projeto) {
                                case 'AP':
                                    $label = "success";
                                    $content = "Aprovado";
                                    break;
                                
                                case 'AA':
                                    $label = "warning";
                                    $content = "Aguardando Aprovação";
                                    break;
                                    
                                case 'CS': 
                                    $label = "default";
                                    $content = "Cancelado Suspenso";
                                    break;

                                case 'RP':
                                    $label = "default";
                                    $content = "Reprovado";
                                    break;

                                    
                                case 'EX':
                                    $label = "default";
                                    $content = "Excluído";
                                    break;
                            }
                        @endphp
                        <label class="label label-{{$label}}"> {{ $content }} </label>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                   <b> Usuário responsável </b>
                </div>
                <div class="col-md-6"> 
                    <p> {{ $projeto->nome_usuario_responsavel }} </p>
                </div>
            </div>
        </div> 
    </div>
@endsection 

@section('btn_fechar', 'Fechar')