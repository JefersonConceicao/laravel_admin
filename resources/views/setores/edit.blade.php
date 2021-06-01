@extends('layouts.modals')
@section('form_modal', 'editFormSetor')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Setor
@endsection
@section('modal_content')
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('sigla', 'Sigla') }} <span class="required"> * </span>
                {{ Form::text('sigla', $dataSetor->sigla, [
                    'class' => 'form-control', 
                    'id' => 'add_form_setor_sigla'
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('descsetor', 'Descrição do Setor') }} <span class="required"> * </span>
                {{ Form::text('descsetor', $dataSetor->descsetor, [
                    'class' => 'form-control', 
                    'id' => 'add_form_setor_descsetor'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $dataSetor->ativo, [
                    'class' => 'form-control select2',
                    'id' => 'add_form_setor_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-9">
            {{ Form::label('e_mail', 'E-mail') }}
            {{ Form::email('e_mail', $dataSetor->e_mail, [
                'class' => 'form-control',
                'id' => 'add_form_setor_e_mail'
            ])}}

            <div class="error_feedback"> </div>        
        </div>
        <div class="col-md-3">
            {{ Form::label('hierarquia', 'Hierarquia') }} <span class="required"> * </span>
            {{ Form::text('hierarquia', $dataSetor->hierarquia, [
                'class' => 'form-control',
                'id' => 'add_form_setor_hierarquia'
            ])}}
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')