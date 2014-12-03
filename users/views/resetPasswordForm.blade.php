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
                    {{ Form::open(array('route' => 'app.users.handle.reset.password', 'method' => 'post')) }}

                        <legend>{{ trans('users::app.reset-password') }}</legend>
                        <input type="hidden" name="token" value="{{{ $token }}}">
                        <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

                        <div class="form-group">
                            {{ Form::label('password', trans('users::app.password')); }}
                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('users::app.password') )) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password_confirmation', trans('users::app.password_confirmation')); }}
                            {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => trans('users::app.password_confirmation') )) }}
                        </div>

                        {{ Form::submit(trans('users::app.set_password'), array('class' => 'btn btn-lg btn-primary btn-block')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>



@stop