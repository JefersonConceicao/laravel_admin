@extends('layouts.modals')
@section('form_modal', 'editInfraLocalidades')

@section('modal-header')
    <i class="fa fa-edit"> </i> Editar Infraestrutura da localidade 
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('tipo_id', 'Tipo da Infraestrutura') }}
                {{ Form::select('tipo_id', $comboTI, null, [
                    'class' => 'form-control select2',
                    'id' => 'form_add_infraestrutura_localidade_tipo_id'
                ])}}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('descricao', 'Descrição') }}
                {{ Form::text('descricao', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_infraestrutura_localidade_descricao'
                ])}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('quantidade', 'Quantidade') }}
                {{ Form::text('quantidade', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_infraestrutura_localidade_quantidade'
                ])}}
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')
