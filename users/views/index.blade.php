@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.users.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;')) }}

<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('app.admin.users.create') }}">{{ trans('users::app.add.user') }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans('users::app.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( count($users) )
                <table class="table table-striped table-hover table-condensed pageblok-item-list">
                    <tr>
                        <th></th>
                        <th>{{{ trans('users::app.first_name') }}}</th>
                        <th>{{{ trans('users::app.last_name') }}}</th>
                        <th>{{{ trans('users::app.email') }}}</th>
                        <th class="status-column">{{ trans('users::app.status') }}</th>
                    </tr>
                @foreach ( $users as $user )
                    <tr>
                        <td>
                            {{ Form::checkbox('id[]', $user->id); }}
                        </td>
                        <td>{{ link_to_route('app.admin.users.edit', $user->first_name, array('userid' => $user->id)); }}</td>
                        <td>{{ link_to_route('app.admin.users.edit', $user->last_name, array('userid' => $user->id)); }}</td>
                        <td>{{ link_to_route('app.admin.users.edit', $user->email, array('userid' => $user->id)); }}</td>
                        <td>
                            @if ($user->confirmed)
                            <span class="label label-success">{{ trans('users::app.confirmed') }}</span>
                            @else
                            <span class="label label-warning">{{ trans('users::app.not_confirmed') }}</span>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </table>
            @endif
        </div>
    </div>
</div>
{{ Form::close() }}
@stop
