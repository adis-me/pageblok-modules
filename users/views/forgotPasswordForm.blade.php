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
                    {{ Form::open(array('route' => 'app.users.handle.forgot.password', 'method' => 'post')) }}

                        <legend>{{ trans('users::app.reset-password') }}</legend>

                        <div class="form-group">
                            {{ Form::label('email', trans('users::app.email')); }}
                            {{ Form::text('email', null, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('users::app.email'))); }}
                        </div>

                        {{ Form::submit(trans('users::app.reset'), array('class' => 'btn btn-lg btn-primary btn-block')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@stop