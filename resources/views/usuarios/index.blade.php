@extends('adminlte::page')
@section('title', 'BT | Usuários')
@section('content') 
    <section class="content-header">
        <h1> Usuários
            <small> 
                <i class="fa fa-users"> </i> 
            </small>
        </h1>
         
        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li class="active"> <a href="#">  Usuários </a> </li>
        </ol>
    </section>

    <section class="content">
        {{-- INICIO COMPONENT FILTRO  --}}
        @component('components.filtro')
            <form id="searchUser"> 
                <div class="row">
                    <div class="col-md-3">  
                        <div class="form-group">
                            {{ Form::label ('nome', 'Nome')}}
                            {{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Pesquise por nome'])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label ('email', 'E-mail')}}
                            {{ Form::text('email', null, [
                                'type' => 'email', 
                                'class' => 'form-control', 
                                'placeholder' => 'Pesquise por e-mail',
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                            {{ Form::label('role', 'Perfil') }}
                            {{ Form::select('role', $roles, [], [
                                'class' => 'form-control select2',
                                'placeholder' => 'Selecione uma opção'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('setor','Setor') }}
                            {{ Form::select('setor', $setores, [], [
                                'class' => 'form-control select2',
                                'placeholder' => 'Selecione uma opção'
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pull-left">
                        <button type="reset" class="btn btn-primary" id="clear_filter_user">
                            <i class="fa fa-eraser" aria-hidden="true"> </i>
                            Limpar Pesquisa 
                        </button>

                        <button type="submit" class="btn btn-primary"> 
                            <i class="fa fa-search"> </i>
                            Pesquisar
                        </button>
                    </div>
                </div>
            </form>
        @endcomponent
        {{-- FIM COMPONENT FILTRO  --}}

        {{--- Início grid --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box" id="gridUsers">
                    <div class="box-header with-border">
                        <p class="box-title"> 
                            Total de registros: {{ count($dados) }}
                        </p>
                        <a href="#" id="cadastrarUser" class="btn btn-primary pull-right" bt_ac="users.create"> 
                            <i class="fa fa-plus-square"> </i>   
                               &nbsp Novo  
                        </a>
                    </div>
                    @if(count($dados) > 0)
                        <div class="box-body table-responsive" style="overflow:auto;">
                            <table class="table table-hover">
                                <thead> 
                                    <tr> 
                                        <th> Nome </th>
                                        <th> Usuário </th>
                                        <th> Perfil </th>
                                        <th> Email </th>
                                        <th> Setor
                                             </th>
                                        <th class="text-center" style="width:8%;"> 
                                            Ações 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dados as $dado) 
                                        <tr> 
                                            <td> {{!empty($dado->name) ? $dado->name : "Não informado"}} </td>
                                            <td> {{!empty($dado->username) ? $dado->username : "Não informado"}} </td>
                                            <td> {{!empty($dado->name_role) ? $dado->name_role : "Não informado"}}    </td>
                                            <td> {{!empty($dado->email) ? $dado->email : "Não informado"}} </td>
                                            <td> {{!empty($dado->userSetor->descsetor) ? $dado->userSetor->descsetor :  "Não informado" }} </td> 
                                            
                                            <td class="text-center" style="display:flex; justify-content:space-between;">     
                                                <a
                                                    href="#" 
                                                    bt_ac="users.edit" 
                                                    class="btn btn-xs btn-primary" 
                                                    data-toggle="tooltip" 
                                                    title="Editar"
                                                >
                                                     <i class="fa fa-edit"> </i>
                                                </a>    
                                                
                                                <a      
                                                    href="#" 
                                                    class="btn btn-xs btn-success" 
                                                    title="Visualizar" 
                                                    data-toggle="Visualizar"
                                                > 

                                                    <i class="fa fa-bars"> </i>
                                                </a>

                                                <a 
                                                    href="#" 
                                                    class="btn btn-xs btn-danger" 
                                                    title="Excluir" 
                                                    data-toggle="Excluir"
                                                >
                                                    <i class="fa fa-trash"> </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach                            
                                </tbody>
                            </table>
                        @else
                            @component('components.emptyTable') @endcomponent
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{--- fim grid --}}
    </section>
@endsection