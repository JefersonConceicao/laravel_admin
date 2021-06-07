@extends('adminlte::page')
@section('title', 'BT | Checklist Itens')
@section('content')
    <section class="content-header">
        <h1> 
            Checklist de Itens
            <small>
                <i class="fa fa-list-ul"> </i>
            </small>
        </h1>
        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
            <li class="active"> <a href="#"> Checklist de itens </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="formSearchCheckListItens"> 
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('descricao_item', 'Descrição do Item') }}
                            {{ Form::text('descricao_item', null, [
                                'class' => 'form-control',
                                'id' => 'form_serach_descricao_item'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo') }}
                            {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                                'class' => 'form-control select2',
                                'id' => 'form_serach_ativo'
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="reset"> 
                            <i class="fa fa-eraser"> </i> Limpar Pesquisa
                        </button>
                        <button class="btn btn-primary" type="submit"> 
                            <i class="fa fa-search"> </i> Localizar
                        </button>
                    </div>
                </div>
            </form> 
        @endcomponent
        <div class="box" id="gridCheckListItem">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                        <p class="box-title"> Total de registros: {{ $dataCheckListItem->total() }} </p>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary pull-right" id="addCheckListItem">
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div> 
                </div>
            </div>
            <div class="box-body table-responsive" >
                <table class="table dataTable">
                    <thead> 
                        <tr> 
                            <th> Descrição do Item </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataCheckListItem as $checkList)
                            <tr> 
                                <td> {{ !empty($checkList->descricao_item) 
                                        ? $checkList->descricao_item 
                                        : "Não informado" }} 
                                </td>
                                <td> 
                                    <label class="label label-{{ $checkList->ativo == "S" ? "success" : "danger"}}"> 
                                        {{ $checkList->ativo == "S"
                                            ? "Sim"
                                            : "Não"
                                        }}
                                    </label>    
                                </td>
                                <td> 
                                   <div style="display:flex; justify-content:space-around;">
                                        <button 
                                            class="btn btn-xs btn-primary btnEditChecklistItem"
                                            id="{{ $checkList->id }}"
                                        >
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        <button 
                                            class="btn btn-xs btn-danger btnDeleteChecklistItem"
                                            id="{{ $checkList->id }}"
                                        >
                                            <i class="fa fa-trash"> </i>
                                        </button  on>
                                   </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="indexPagination" style="display:flex; justify-content:center;">
                    {{ $dataCheckListItem->links() }}
                </div>  
            </div>
        </div>
    </section>
@endsection