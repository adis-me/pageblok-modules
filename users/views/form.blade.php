@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => array($formRoute, $user->id), 'method' => 'post', 'class' => 'editor-form create-page', 'files' => true)) }}
<div class="border-bottom">
    <div class="container form-group">
        {{ HTML::linkRoute('app.admin.users',  trans('users::app.cancel'), null, array('class' => 'btn btn-default')) }}
        {{ Form::submit(trans('users::app.save'), array('class' => 'btn btn-success')) }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-9 padded-top border-right">
            <div class="row">
                <div class="form-group col-md-6">
                    {{ Form::label('first_name', trans('users::app.first_name')); }}
                    {{ Form::text('first_name', $user->first_name, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('users::app.first_name'))); }}
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('last_name', trans('users::app.last_name')); }}
                    {{ Form::text('last_name', $user->last_name, array('class' => 'form-control', 'placeholder' => trans('users::app.last_name'))); }}
                </div>
            </div>
            @if ('app.admin.users.create' === $formRoute)
            <div class="form-group">
                {{ Form::label('password', trans('users::app.password')); }}
                {{ Form::text('password', $user->password, array('class' => 'form-control', 'placeholder' => trans('users::app.password'))); }}
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', trans('users::app.password_confirmation')); }}
                {{ Form::text('password_confirmation', $user->password, array('class' => 'form-control', 'placeholder' => trans('users::app.password_confirmation'))); }}
            </div>
            @endif

            <div class="form-group">
                {{ Form::label('username', trans('users::app.username')); }}
                {{ Form::text('username', $user->username, array('class' => 'form-control', 'placeholder' => trans('users::app.username'))); }}
            </div>

            <div class="form-group">
                {{ Form::label('email', trans('users::app.email')); }}
                {{ Form::text('email', $user->email, array('class' => 'form-control', 'placeholder' => trans('users::app.email'))); }}
            </div>
        </div>
        <div class="col-md-3 padded-top ">
            <p><strong>{{{ trans('users::app.permissions') }}}</strong></p>
            <div class="form-group">
                <div class="checkbox">
                    <label>

                            {{ Form::checkbox('roles[Administrator]', 'Administrator', ($user->hasRole('Administrator')) ? true : false ); }}
                        Administrator (Website beheren)
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('roles[Customer]', 'Customer', ($user->hasRole('Customer')) ? true : false ); }}
                        Klant (Kan producten kopen)
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
