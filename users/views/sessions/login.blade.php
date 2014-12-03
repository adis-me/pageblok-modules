@extends("pageblok::templates.plain")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="/packages/adis-me/pageblok/img/pageblok-logo-100.png" class="logo center" alt="Pageblok CMS" />
                <h1>PAGEBLOK <small>CMS</small></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container container-small-form">
            <div class="row">
                <div class="col-md-12">
                    {{ Form::open(array('route' => 'app.session.authenticate', 'method' => 'post')) }}

                        <legend>{{ trans('users::app.signin') }}</legend>

                        <div class="form-group">
                            {{ Form::label('email', trans('users::app.email')); }}
                            {{ Form::text('email', null, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('users::app.email'))); }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', trans('users::app.password')); }}
                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('users::app.password') )) }}
                        </div>

                        {{ Form::submit(trans('users::app.login'), array('class' => 'btn btn-lg btn-primary btn-block')) }}

                        <p class="form-additional-actions text-center">
                            {{ HTML::linkRoute('app.session.register',  trans('users::app.register')) }}
                            {{{ trans('users::app.or') }}}
                            {{ HTML::linkRoute('app.users.forgot.password',  trans('users::app.forgot.password')) }}
                        </p>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@stop