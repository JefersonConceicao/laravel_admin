@extends('layouts.modals')
@section('form_modal', 'editLocalidadeDistancia')
@section('modal-header')
    <i class="fa fa-edit-o"> </i> Editar distância da localidade
@endsection 

@section('modal_content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('localidade_distancia_id', 'Localidade/Município Distância') }} <span class="required"> </span>
                {{ Form::select('localidade_distancia_id', $comboLocalidadeDist, $localidadeDistancia->localidade_distancia_id, [
                    'class' => 'form-control select2',
                    'id' => 'form_edit_localidade_distancia_localidade',
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('distancia', 'Distância' )}} <span class="required"> </span>    
                {{ Form::text('distancia', $localidadeDistancia->distancia, [
                    'class' => 'form-control',
                    'id' => 'form_edit_localidade_distancia_distancia',
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('unidade', 'Unidade' )}} <span class="required"> </span>   
                {{ Form::text('unidade', $localidadeDistancia->unidade , [
                    'class' => 'form-control',
                    'id' => 'form_edit_localidade_distancia_unidade',
                ])}}

                <div class="error_feedback"> </div>
            </div>  
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')