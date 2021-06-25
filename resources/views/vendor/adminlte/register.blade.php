@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <h1> Admin | Laravel </h1>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">{{ "Preencha os campos para se registrar." }} </p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control"
                        placeholder="{{ trans('adminlte::adminlte.full_name') }}"
                    />

                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <div class="error_feedback"> </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        value="{{ old('email') }}"
                        placeholder="{{ trans('adminlte::adminlte.email') }}"
                    >
                    
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <div class="error_feedback"> </div>
                </div>
                
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <div class="error_feedback"> </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    <div class="error_feedback"> </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Enviar
                </button>
            </form>
            <br>
            <p>
                <a href="{{ url(config('adminlte.login_url', 'login')) }}" class="text-center">
                    {{ trans('adminlte::adminlte.i_already_have_a_membership') }}
                </a>
            </p>
        </div>
        <!-- /.form-box -->
    </div><!-- /.register-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
