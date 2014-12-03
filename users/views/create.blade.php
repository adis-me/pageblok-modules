@extends("pageblok::templates.base")

@section('content')
<div class="container content-container">
    <div class="row">
        {{ Form::open(array('route' => 'app.admin.users.save', 'method' => 'post', 'class' => 'edit-form')) }}
        <div class="col-md-12">

            <div class="form-group">
                {{ Form::label('first_name', 'First name'); }}
                {{ Form::text('first_name', $user->first_name, array('class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => 'John')); }}
            </div>
            <div class="form-group">
                {{ Form::label('prefix', 'Prefix'); }}
                {{ Form::text('prefix', $user->prefix, array('class' => 'form-control', 'placeholder' => 'Prefix')); }}
            </div>
            <div class="form-group">
                {{ Form::label('last_name', 'Last name'); }}
                {{ Form::text('last_name', $user->last_name, array('class' => 'form-control', 'placeholder' => 'Doe')); }}
            </div>
            <div class="form-group">
                {{ Form::label('username', 'Username'); }}
                {{ Form::text('username', $user->username, array('class' => 'form-control', 'placeholder' => 'john.doe')); }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'Email'); }}
                {{ Form::text('email', $user->email, array('class' => 'form-control', 'placeholder' => 'john.doe@example.com')); }}
            </div>
            <div class="form-group">
                {{ Form::label('is_cms_admin', 'Is CMS administrator?'); }}
                {{ Form::select('is_cms_admin', array('1' => 'Yes', '0' => 'No'), $user->is_cms_admin , array('class' => 'form-control')); }}
            </div>

            <div class="form-group pull-right">
                {{ HTML::linkRoute('app.admin.users',  'Cancel', null, array('class' => 'btn btn-default')) }}
                {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
            </div>

        </div>
        {{ Form::close() }}
    </div>
</div>
@stop