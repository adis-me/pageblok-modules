@extends("pageblok::templates.base")

@section('content')
{{ Form::open(array('route' => 'app.admin.menus.delete', 'method' => 'post', 'class' => 'pageblok-list-form', 'onkeypress' => 'return event.keyCode != 13;' )) }}
<div class="ts-menu-bar border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('app.admin.menus.create') }}">{{ trans("menus::app.add.menu") }}</a>
                <button class="btn btn-danger extra-actions" style="display: none;" type="submit">{{ trans("menus::app.delete") }}</button>
            </div>
        </div>
    </div>
</div>

<div class="container padded-top">
    <div class="row">
        <div class="col-md-12">
            @if ( count($menus) )
            <table class="table table-striped table-hover table-condensed pageblok-item-list">
                <tr>
                    <th></th>
                    <th>{{ trans('menus::app.description') }}</th>
                    <th>{{ trans('menus::app.title') }}</th>
                    <th>{{ trans('menus::app.items') }} <i class="fa fa-external-link"></i></th>
                    <th class="status-column">{{ trans('menus::app.status') }}</th>
                </tr>
                @foreach ( $menus as $menu )
                <tr>
                    <td>
                        {{ Form::checkbox('id[]', $menu->id); }}
                    </td>
                    <td>{{ link_to_route('app.admin.menus.edit', $menu->description, array('menuid' => $menu->id)); }}</td>
                    <td>{{ link_to_route('app.admin.menus.edit', $menu->pb_name, array('menuid' => $menu->id)); }}</td>
                    <td>
                        {{ link_to_route('app.admin.menus.items', $menu->items()->count(), array('menuid' => $menu->id), array('class' => 'btn btn-default btn-xs')); }}
                    </td>
                    <td>
                        @if ($menu->published)
                        <span class="label label-success">{{ trans("menus::app.published") }}</span>
                        @else
                        <span class="label label-warning">{{ trans("menus::app.draft") }}</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </table>
            @else
            <p class="alert alert-info">You have no menus defined. You should <a href="{{ route('app.admin.menus.create') }}">create a menu</a></p>
            @endif
        </div>
    </div>
    {{ Form::close() }}
</div>
@stop
